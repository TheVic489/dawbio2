import pandas as pd
import numpy as np
from IPython.display import display


df_animals = pd.DataFrame({'num_legs': [2, 4, 4, 8, 6], 'num_wings': [2, 0, np.nan, np.nan, 2]}, index=['falcon', 'dog', 'cat', 'spider', 'butterfly'])
print(df_animals)

# Generador
dates      = pd.date_range("20130101", periods=6)
df_random  = pd.DataFrame(np.random.randn(6, 4), index=dates, columns=list("ABCD"), dtype='float')
print(df_random)

# Print dtypes
print(df_random.dtypes)

#rows x cols
print(df_random.shape)

# Statistics from each column   
print(df_random.describe())

#les notes de dawbio amb dataframe
student_list    = ["John","Mary","Lucy","Peter"]
grades_list     = [7,9,8,4]
wants_dual_list = [False,True,False,True]

data: dict[list] = {
      "grade": grades_list,
      "dual" : wants_dual_list
      }

students_frame = pd.DataFrame(
    index = student_list,
    data  = data
    )
print(f"{students_frame}\n")

# Mostra desde "cat" fins "butterfly"
print(df_animals["cat":"butterfly"])

df2 = pd.DataFrame(
    {
        "A": 1.0,
        "B": pd.Timestamp("20031013"),
        "C": pd.Series(1.123, index=list(range(4)), dtype="float32"),
        "D": np.array([2] * 4, dtype="int32"),
        "E": pd.Categorical(["test", "train", "test", "train"]),
        "F": "fool",
    }
)
# Creates csv file, separated by ;
df2.to_csv('dataframe_test.csv', sep=';')


animals_df = pd.Series(data=['falcon', 'dog', 'snail', 'spider'], dtype="string")
df3        = pd.DataFrame(
    {
        "A": [1.0] + [np.nan] * 2 + [3.0],
        "B": pd.date_range("20220101", periods=4, freq='D'),
        "C": animals_df,
        "D": pd.Categorical(["Male", "Female", "NS/NC", "Female"]),
        "E": "foo",
    }
)
print(df3)

#les notes de dawbio amb dataframe
student_list    = ["John","Mary","Lucy","Peter", "Victor", "Pau"]
grades_list     = [7, 9, 8, 4, 10, 8]
wants_dual_list = [False, True, False, True, False, True]

datos: dict[list] = {
    "grade": grades_list,
    "dual" : wants_dual_list
    }

students_frame = pd.DataFrame(
    index = student_list,
    data  = datos
    )
print(students_frame)


# Ordenar numèric
#students_frame_sorted = students_frame.sort_index( by=['grade'], 
 #                                                  axis=0, 
  #                                                 ascending=False)
#print(students_frame_sorted)

#students_frame_sorted = students_frame.sort_values(by=["student_list"],ascending=True)
#print(students_frame_sorted)

# Ordenar alfabètic.
#students_frame_sorted = students_frame.sort_values(by=["student_list"],ascending=True)
#print(students_frame_sorted)

#si vull totes les notes dels estudiants, a la fila poso un slice buit
#students_frame.iloc[:,"grade"]


# Utilitzar sempre localització d'un atribut
# .loc rep 2 parametres('enfonsar-se','bucejar')
students_frame.loc["Lucy","grade"]


#si vull totes les notes dels estudiants, a la fila poso un slice buit
students_frame.loc[:,"grade"]

#La primera coordenada capbusada | i despres bucejo -> però amb numèrics.
students_frame.iloc[0,1]


# Les 2 consultes retornen el mateix resultat.
# at = loc opt.
print(students_frame.at["Lucy","grade"])
# iat = loc opt.
print(students_frame.iat[2,0])

#Podemos devolver una lista de varias filas, devuelve una lista
students_frame.loc[["Mary","Lucy"],"grade"]

#Podem retornar una llista de varies files, i retorna una llista
students_frame2 = students_frame.loc[["Mary","Lucy","Victor"],
                                    ["grade","dual"]]
students_frame.loc[["Mary","Lucy"],
                   ["grade","dual"]]
print("llista varies files")
print(students_frame2)





