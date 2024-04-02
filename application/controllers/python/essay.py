import json
import sys
import nltk
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from nltk.corpus import stopwords

def tokenize(jawaban):
    token = nltk.tokenize.word_tokenize(jawaban)
    return token

def stemming(jawaban):
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()
    return stemmer.stem(jawaban)

# def load(filename):
#     with open(filename) as datafile:
#         data = json.load(datafile)
#     return data

# mydict = load('dict.json')
# def get_sinonim(word):
#     if(word in mydict.keys()):
#         return mydict[word]['sinonim'][0]
#     else:
#         return []
    
# def ubah_keyword_sinonim(hasil_keyword):
#     hasil = []
#     for i in hasil_keyword:
#         a = get_sinonim(i)
#         if not a:
#             hasil.append(i)
#         else:
#             hasil.append(a)
#     return stemming(hasil)

if len(sys.argv[1]) > 1:
    sentence = tokenize(sys.argv[1])
    stopwords = set(stopwords.words('indonesian'))
    sentence_without_stopword = [word for word in sentence if not word in stopwords]
    sentence_result = ' '.join(sentence_without_stopword)
    print(stemming(sentence_result))
else:
    print('Hello')


    