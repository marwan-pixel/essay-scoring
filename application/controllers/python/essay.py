import torch
import math
from sentence_transformers import SentenceTransformer, util
from deep_translator import GoogleTranslator
import json
from http.server import BaseHTTPRequestHandler, HTTPServer

class RequestHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        try:
            content_length = int(self.headers['Content-Length'])
            post_data = self.rfile.read(content_length)
            data = json.loads(post_data)
            
            def translated_text(text):
                translated_text = GoogleTranslator(source='auto', target='en').translate(text)
                return translated_text
            
            def encode_text(text):
                model = SentenceTransformer("all-MiniLM-L6-v2")
                inputs = model.encode(translated_text(text), convert_to_numpy=True)
                return inputs

            def winnowing(tensor, window_size=2):
                tensor_list = tensor.tolist()
                winnow = [min(tensor_list[i:i+(window_size - 1)]) for i in range(len(tensor_list)-window_size+1)]
                return winnow

            def calculate_semantic_similarity(text1, text2):
                dot_product = 0
                magnitude_A = 0
                magnitude_B = 0

                text1_list = text1
                text2_list = text2
                
                for i in range(len(text1_list)):
                    dot_product += (text1_list[i]) * text2_list[i]

                for i in range(len(text1_list)):
                    magnitude_A += text1_list[i] * text1_list[i]
                
                for i in range(len(text2_list)):
                    magnitude_B += text2_list[i] * text2_list[i]
                
                magnitude_A = math.sqrt(magnitude_A)
                magnitude_B = math.sqrt(magnitude_B)

                similarity = dot_product / (magnitude_A * magnitude_B)

                return dot_product, magnitude_A, magnitude_B, similarity
            
            jawaban_essay = data['jawaban_esai']
            kunci_jawaban_essay = data['kunci_jawaban_esai']
            
            jawaban_essay_translated = translated_text(jawaban_essay)
            kunci_jawaban_essay_translated = translated_text(kunci_jawaban_essay)

            jawaban_essay_encode = encode_text(jawaban_essay_translated)
            kunci_jawaban_encode = encode_text(kunci_jawaban_essay_translated)

            winnowing_jawaban_essay = winnowing(jawaban_essay_encode)
            winnowing_kunci_jawaban = winnowing(kunci_jawaban_encode)
            dot_product, magnitude_esai, magnitude_kj, result = calculate_semantic_similarity(winnowing_jawaban_essay, winnowing_kunci_jawaban)
            similarity = round(result, 3)
            
            response = {
                'jawaban': jawaban_essay,
                'kunci_jawaban': kunci_jawaban_essay, 
                'winnowing_jawaban_essay': winnowing_jawaban_essay,
                'winnowing_kunci_jawaban': winnowing_kunci_jawaban,
                'dot_product': dot_product,
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