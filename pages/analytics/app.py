#: C:\Users\Nelmark\AppData\Local\Programs\Python\Python39\python.exe
import os
from array import array
import pickle
import sys
import warnings


warnings.filterwarnings('ignore')

# Get the current working directory
cwd = os.getcwd()

# Construct the full path to the model file
model_path = os.path.join(cwd, 'finalnewsavednewmodel.sav')

# Load the model from the file
with open(model_path, 'rb') as f:
    model = pickle.load(f)

num1 = int(sys.argv[1])
num2 = int(sys.argv[2])
num3 = int(sys.argv[3])
num4 = int(sys.argv[4])
num5 = int(sys.argv[5])
num6 = int(sys.argv[6])
num7 = int(sys.argv[7])
num8 = int(sys.argv[8])
num9 = int(sys.argv[9])
num10 = int(sys.argv[10])
num11 = int(sys.argv[11])
num12 = int(sys.argv[12])
num13 = int(sys.argv[13])
num14 = int(sys.argv[14])
num15 = int(sys.argv[15])
num16 = int(sys.argv[16])        

result = model.predict([[num1,num2,num3,num4,num5,num6,num7,num8,num9,num10,num11,num12,num13,num14,num15,num16]])


print(str(result))



