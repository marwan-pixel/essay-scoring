import numpy as np
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
import nltk
from nltk.tokenize import word_tokenize
from mpstemmer import MPStemmer
from sentence_transformers import SentenceTransformer
import json
from typing import List, Union, Literal
from http.server import BaseHTTPRequestHandler, HTTPServer
from sklearn.metrics.pairwise import cosine_similarity

class RequestHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        try:
            content_length = int(self.headers['Content-Length'])
            post_data = self.rfile.read(content_length)
            data = json.loads(post_data)

            def tokenize(jawaban):
                token = nltk.tokenize.word_tokenize(jawaban)
                return token

            def stop_words(token):
                stop_factory = StopWordRemoverFactory()
                sentence_without_stopword = [word for word in token if not word in stop_factory.get_stop_words()]
                sentence_result = ' '.join(sentence_without_stopword)
                return sentence_result

            def stemming(kalimat):
                stemmer = MPStemmer()
                return stemmer.stem_kalimat(kalimat)
            
            def sinonim_kata(kalimat_pertama, kalimat_kedua):
                model = SentenceTransformer("naufalihsan/indonesian-sbert-large")
                token_1 = word_tokenize(kalimat_pertama.lower())
                token_2 = word_tokenize(kalimat_kedua.lower())
                synonym_mapping = {}

                vectors_2 = {token: model.encode([token])[0] for token in token_2}

                for token1 in token_1:
                    max_similarity = 0
                    best_token2 = ""

                    # Encode token1 to vector
                    vec1 = model.encode([token1])[0].reshape(1, -1)

                    for token2, vec2 in vectors_2.items():
                        vec2 = vec2.reshape(1, -1)

                        # Ensure vec1 and vec2 are numpy arrays
                        vec1_np = np.array(vec1)
                        vec2_np = np.array(vec2)

                        # Compute cosine similarity
                        similarity = cosine_similarity(vec1_np, vec2_np)[0][0]

                        if similarity > max_similarity:
                            max_similarity = similarity
                            best_token2 = token2

                    # Use a threshold for synonym similarity
                    if max_similarity > 0.6:
                        synonym_mapping[token1] = best_token2

                # Replace tokens in text1 based on synonym_mapping
                perubahan_token_1 = [synonym_mapping.get(token, token) for token in token_1]
                kalimat_sinonim = ' '.join(perubahan_token_1)
                return kalimat_sinonim

            def n_gram(text, n):
                text = text.replace(" ", "")
                output = []
                if len(text) < n:
                    n = len(text)
                for i in range(len(text) - n +1):
                    output.append(text[i:i+n])
                return output

            def rolling(text, prima = 5):
                array = []
                for i in text:
                    total = 0
                    karakter = len(i)
                    for j in i:
                        pangkat = karakter-1
                        temp = prima ** (pangkat)
                        total +=ord(j)*temp
                        karakter -= 1
                    array.append(total)
                return array

            def similarity_text(set1, set2):
                set1 = set(nltk.tokenize.word_tokenize(set1))
                set2 = set(nltk.tokenize.word_tokenize(set2))
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
                text1_a = set(text1)
                text2_a = set(text2)
                intersection = (text1_a & text2_a)
                if(len(intersection) == 0):
                    similarity = 0
                else:
                    text1_list = (text1)
                    text2_list = (text2)

                    dot_product = np.dot(text1_list, text2_list)
                    magnitude_A = np.linalg.norm(text1_list)
                    magnitude_B = np.linalg.norm(text2_list)

                    # magnitude_A = math.sqrt(magnitude_A)
                    # magnitude_B = math.sqrt(magnitude_B)

                    similarity = dot_product / (magnitude_A * magnitude_B)

                return dot_product, magnitude_A, magnitude_B, similarity
            
            jawaban_essay = data['jawaban_esai']
            kunci_jawaban_essay = data['kunci_jawaban_esai']

            # jawaban_essay_1 = jawaban_essay

            jawaban_essay = sinonim_kata(jawaban_essay, kunci_jawaban_essay)

            jawaban_essay_token = tokenize(jawaban_essay)
            kunci_jawaban_essay_token = tokenize(kunci_jawaban_essay)

            jawaban_essay_stopwords = stop_words(jawaban_essay_token)
            kunci_jawaban_stopwords = stop_words(kunci_jawaban_essay_token)

            jawaban_essay_stemming = stemming(jawaban_essay_stopwords)
            kunci_jawaban_stemming = stemming(kunci_jawaban_stopwords)

            jawaban_essay_stemming = similarity_text(jawaban_essay_stemming, kunci_jawaban_stemming)
            kunci_jawaban_stemming = list(dict.fromkeys(nltk.tokenize.word_tokenize(kunci_jawaban_stemming)))
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
                similarity_result = similarity(winnowing_jawaban_essay, winnowing_kunci_jawaban)
                similarity = result # type: ignore
            
            response = {
                'jawaban': jawaban_essay,
                'kunci_jawaban': kunci_jawaban_essay, 
                'winnowing_jawaban_essay': winnowing_jawaban_essay,
                'winnowing_kunci_jawaban': winnowing_kunci_jawaban,
                'dot_product': str(dot_product),
                'magnitude_esai': magnitude_esai,
                'magnitude_kj': magnitude_kj,
                'similarity': similarity
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
