from pathlib import Path
from unittest import skip
import numpy as np
import pandas as pd
import copy 

# Read scimago ranking
entries: pd.DataFrame = pd.read_csv("scimago-medicine.csv", on_bad_lines="skip")

#Canviar valors H Index menor a 750, i posar-los a 0.


#canviar totes les entrades menors de 750 a h_index negatiu
entries2 = copy.deepcopy(entries)

# Màscara per a seleccionar només els que tenen menys de 750
bad_entries_mask = (entries2.loc[:,"H index"] < 750)

# Aquesta és la lína que edita els H Index, els posa un 0. 
entries2.loc[bad_entries_mask,"H index"] = 0;

# Ordena els valors i mostra els 10 primers.
entries2.sort_values(by=["H index"], 
                          axis=0, 
                          ascending=False).head(10)

print("Canvi valors.")
#Provem que ha funcionat
print(entries2.loc[:,["Title","H index"]])



# Canviem el tipus de publicació, de Journal a Diari.

# Opcions de mask.
journals = entries2.loc[:,"Type"] == 'journal'
#journals = entries2.loc[:,"Type"].str.contains('journal')
print(journals.head(100))

# Aquesta és la lína que edita els H Index, els posa un 0. 
entries2.loc[journals,"Type"] = 'Diari';


print(entries2.loc[:,["Title","Type"]])

# També ho podem fer amb el replace.

entries3 = entries2.replace('journal','diari')
print(entries3.loc[:,["Title","Type"]])

