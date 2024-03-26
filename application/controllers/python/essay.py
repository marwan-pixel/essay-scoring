import sys
import nltk
nltk.download()
if len(sys.argv) > 1:
    name = sys.argv[1]
    print(name)
else:
    print('Hello')
# lowercase_sentence = sentence.lower()
# print(lowercase_sentence)