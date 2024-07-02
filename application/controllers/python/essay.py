import sys
import torch
from sentence_transformers import SentenceTransformer, util
from deep_translator import GoogleTranslator
from mpstemmer import MPStemmer
import json

model = SentenceTransformer("all-MiniLM-L6-v2")

def preprocessed_text(text):
    stemmer = MPStemmer()
    translated_text = GoogleTranslator(source='auto', target='en').translate(stemmer.stem(text))
    return translated_text

def encode_text(text):
    inputs = model.encode(text, convert_to_tensor=True)
    return inputs

def winnowing(tensor, window_size=1):
    tensor_list = tensor.tolist()
    winnow = [min(tensor_list[i:i+window_size]) for i in range(len(tensor_list)-window_size+1)]
    return torch.tensor(winnow)

def calculate_semantic_similarity(text1, text2):
    return util.pytorch_cos_sim((text1),(text2)) # type: ignore

if len(sys.argv[1]) > 1 and len(sys.argv[2]) > 1:
    # sentence = tokenize(sys.argv[1])
    # stemmer = MPStemmer()
    # stopwords = set(stopwords.words('indonesian'))
    # sentence_without_stopword = [word for word in sentence if not word in stopwords]
    # sentence_result = ' '.join(sentence_without_stopword)
    # print(stemmer.stem_kalimat(sentence_result))
    jawaban_essay = sys.argv[1]
    kunci_jawaban_essay = sys.argv[2]

    processed_essay = preprocessed_text(jawaban_essay.lower())
    processed_kunci_jawaban = preprocessed_text(kunci_jawaban_essay.lower())

    jawaban_essay_encode = encode_text(processed_essay)
    kunci_jawaban_encode = encode_text(processed_kunci_jawaban)

    winnowing_jawaban_essay = winnowing(jawaban_essay_encode)
    winnowing_kunci_jawaban = winnowing(kunci_jawaban_encode)
    result = calculate_semantic_similarity(winnowing_jawaban_essay, winnowing_kunci_jawaban)[0][0]
    similarity = round(result.item(), 3)
    print(similarity)
else:
    print('')