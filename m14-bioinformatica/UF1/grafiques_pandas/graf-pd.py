import numpy as np 
import pandas as pd
#np --> numerical panda, es una llibreria per a realitzar càlcul numèric
#les notes de dawbio amb series
student_list = ["John","Mary","Lucy","Peter"]
grades_list  = [7,9,8,4]
wants_dual_list = [False,True,False,True]

datos: dict[str, list] = {
    "grade": grades_list,
    "dual": wants_dual_list}  
    
students_frame = pd.DataFrame(
    index = student_list,
    data  = datos
)

students_frame.loc[:,"grade"].plot(kind="bar")

