import numpy as np
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from mpstemmer import MPStemmer
from sentence_transformers import SentenceTransformer
import json
from typing import List, Union, Literal
from http.server import BaseHTTPRequestHandler, HTTPServer
from sklearn.metrics.pairwise import cosine_similarity
import concurrent.futures

class RequestHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        try:
            content_length = int(self.headers['Content-Length'])
            post_data = self.rfile.read(content_length)
            data = json.loads(post_data)

            def stop_words(kalimat):
                token = word_tokenize(kalimat.lower())
                # factory = StopWordRemoverFactory()
                indonesian_stopword = set(stopwords.words('indonesian'))
                english_stopword = set(stopwords.words('english'))
                hasil_stopword = [word for word in token if not word in indonesian_stopword.union(english_stopword)]
                kalimat_tanpa_stop_words = " ".join(hasil_stopword)
                return kalimat_tanpa_stop_words

            def stemming(kalimat):
                stemmer = MPStemmer()
                return stemmer.stem_kalimat(kalimat)
            
            def encode_tokens(model, tokens):
                return {token: vec for token, vec in zip(tokens, model.encode(tokens, batch_size=8))}
            
            def sinonim_kata(kalimat_pertama, kalimat_kedua):
                model = SentenceTransformer("naufalihsan/indonesian-sbert-large")
                token_1 = word_tokenize(kalimat_pertama.lower())
                token_2 = word_tokenize(kalimat_kedua.lower())
                synonym_mapping = {}

                with concurrent.futures.ThreadPoolExecutor() as executor:
                    future_tokens_2 = executor.submit(encode_tokens, model, token_2)
                    vectors_1 = model.encode(token_1, batch_size=8)
                    vectors_2 = future_tokens_2.result()

                for token1, vec1 in zip(token_1, vectors_1):
                    max_similarity = 0
                    best_token2 = ""
                    
                    vec1 = vec1.reshape(1, -1)

                    for token2, vec2 in vectors_2.items():
                        vec2 = vec2.reshape(1, -1)
                        
                        # Compute cosine similarity
                        similarity = cosine_similarity(vec1, vec2)[0][0] # type: ignore

                        if similarity > max_similarity:
                            max_similarity = similarity
                            best_token2 = token2

                    # Use a threshold for synonym similarity
                    if max_similarity > 0.6:
                        synonym_mapping[token1] = best_token2

                # Replace tokens in kalimat_pertama based on synonym_mapping
                perubahan_token_1 = [synonym_mapping.get(token, token) for token in token_1]
                kalimat_sinonim = ' '.join(perubahan_token_1)
                return kalimat_sinonim

            def n_gram(text, n):
                text = text.replace(" ", "")
                if len(text) < n:
                    n = len(text)
                return [text[i:i+n] for i in range(len(text) - n + 1)]

            def rolling(text, prima = 5):
                return [
                    sum(ord(j) * (prima ** (len(i) - idx - 1)) for idx, j in enumerate(i))
                    for i in text
                ]

            def similarity_text(set1, set2):
                set1 = set(word_tokenize(set1))
                set2 = set(word_tokenize(set2))
                intersection =(set1 & set2)
                return " ".join(intersection)

            def winnowing(text, w):
                # text = text.split(" ", '')
                if len(text) < w:
                    w = len(text)
                winnow = [min(text[i:i+(w)]) for i in range(len(text)-w+1)]
                return winnow
            
            def similarity(list1: List[str], list2: List[str]) -> Union[float, Literal[0]]:
                set1 = set(list1)
                set2 = set(list2)
                intersection = len(set1 & set2)
                union = len(set1 | set2)
                return intersection / union if union != 0 else 0
            
            def calculate_semantic_similarity(text1, text2):
                length = max(len(text1), len(text2))
                text1 = np.pad(text1, (0, length - len(text1)), 'constant', constant_values=0)
                text2 = np.pad(text2, (0, length - len(text2)), 'constant', constant_values=0)
                dot_product = 0
                magnitude_A = 0
                magnitude_B = 0

                text1_list = (text1)
                text2_list = (text2)

                dot_product = np.dot(text1_list, text2_list)
                magnitude_A = np.linalg.norm(text1_list)
                magnitude_B = np.linalg.norm(text2_list)

                similarity = dot_product / (magnitude_A * magnitude_B)
                # text1_a = set(text1)
                # text2_a = set(text2)
                # intersection = (text1_a & text2_a)
                # if(len(intersection) == 0):
                #     similarity = 0
                # else:
                    

                return dot_product, magnitude_A, magnitude_B, similarity
            
            jawaban_essay = data['jawaban_esai']
            kunci_jawaban_essay = data['kunci_jawaban_esai']
            bobot_soal = data['bobot']

            jawaban_essay_stopwords = stop_words(jawaban_essay)
            kunci_jawaban_stopwords = stop_words(kunci_jawaban_essay)

            jawaban_essay_stopwords = sinonim_kata(jawaban_essay_stopwords, kunci_jawaban_stopwords)

            jawaban_essay_stemming = stemming(jawaban_essay_stopwords)
            kunci_jawaban_stemming = stemming(kunci_jawaban_stopwords)

            jawaban_essay_stemming = similarity_text(jawaban_essay_stemming, kunci_jawaban_stemming)
            kunci_jawaban_stemming = list(dict.fromkeys(word_tokenize(kunci_jawaban_stemming)))
            kunci_jawaban_stemming = " ".join(kunci_jawaban_stemming)
                
            jawaban_essay_ngram = n_gram(jawaban_essay_stemming, 3)
            kunci_jawaban_ngram = n_gram(kunci_jawaban_stemming, 3)   

            jawaban_essay_rolling = rolling(jawaban_essay_ngram)
            kunci_jawaban_rolling = rolling(kunci_jawaban_ngram)

            winnowing_jawaban_essay = winnowing(jawaban_essay_rolling, 3)
            winnowing_kunci_jawaban = winnowing(kunci_jawaban_rolling, 3)
            
            if(len(kunci_jawaban_essay) == 0):
                dot_product = magnitude_esai = magnitude_kj = similarity = 0 # type: ignore
            else:
                dot_product, magnitude_esai, magnitude_kj, result = calculate_semantic_similarity(winnowing_jawaban_essay, winnowing_kunci_jawaban)
                # similarity_result = similarity(winnowing_jawaban_essay, winnowing_kunci_jawaban)
                similarity = result # type: ignore
            
            response = {
                'jawaban_awal': jawaban_essay,
                'kunci_jawaban_awal': kunci_jawaban_essay,
                'jawaban_preprocessing': jawaban_essay_stopwords,
                'kunci_jawaban_preprocessing': stop_words(kunci_jawaban_essay),
                'stemming_jawaban': jawaban_essay_stemming,
                'stemming_kj': kunci_jawaban_stemming,
                'n_gram_jawaban': jawaban_essay_ngram,
                'n_gram_kunci_jawaban': kunci_jawaban_ngram,
                'rolling_hash_jawaban': jawaban_essay_rolling,
                'rolling_hash_kj': kunci_jawaban_rolling,
                'winnowing_jawaban_essay': winnowing_jawaban_essay,
                'winnowing_kunci_jawaban': winnowing_kunci_jawaban,
                'dot_product': str(dot_product),
                'magnitude_esai': magnitude_esai,
                'magnitude_kj': magnitude_kj,
                'similarity': similarity,
                'nilai_perolehan': round(similarity * bobot_soal)
            }

            self.send_response(200)
            self.send_header('Content-type', 'application/json')
            self.end_headers()
            self.wfile.write(json.dumps(response).encode())
        except Exception as e:
            self.send_response(500)
            self.send_header('Content-type', 'application/json')
            self.end_headers()
            self.wfile.write(json.dumps({'error': str(e)}).encode())

def run(server_class=HTTPServer, handler_class=RequestHandler, port=5000):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f'Starting httpd server on port {port}')
    httpd.serve_forever()

if __name__ == '__main__':
    run()
