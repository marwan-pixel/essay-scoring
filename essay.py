import sys
import nltk
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from mpstemmer import MPStemmer
from nltk.corpus import stopwords

def tokenize(jawaban):
    token = nltk.tokenize.word_tokenize(jawaban)
    return token

def stemming(jawaban):
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()
    return stemmer.stem(jawaban)

if len(sys.argv[1]) > 1:
    sentence = tokenize(sys.argv[1])
    stemmer = MPStemmer()
    stopwords = set(stopwords.words('indonesian'))
    sentence_without_stopword = [word for word in sentence if not word in stopwords]
    sentence_result = ' '.join(sentence_without_stopword)
    print(stemmer.stem_kalimat(sentence_result))
else:
    print('Hello')

# print(sys.argv[1])