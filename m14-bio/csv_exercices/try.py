def greaterOrEqual5 (num: float) -> bool:
    return num >= 5

llistaNotes: float = [8,5,6.2,4.2,10,6.8,3.4,7.9,9.3,8,2.4,9.7,7.6]

print("Llista notes original.")
print(llistaNotes)

print("Llista notes majors o iguals a 5.")
llistaNotesMajorsIguals5 = list(filter(greaterOrEqual5,llistaNotes))

print(llistaNotesMajorsIguals5)

print("Percentatge aprovats.")
# Dividim la longitud de les notes >5 respecte el total de notes 
# La funció len ens permet veure el número d'elements de les llistes. 
percAprov: int = len(llistaNotesMajorsIguals5) / len(llistaNotes)

## Per arrodonir a 2 decimals usem funció round.
print( str( round(percAprov,4)*100) + ' %') 


llistaEstudiants = ["Roser","Jose","Pablo","Susana","Dora","Amaya","Miquel"]
idEstudiants     = range(1,len(llistaEstudiants)) 

dictionary = {k: v for k, v in zip(idEstudiants, llistaEstudiants)}
print(dictionary)


#EXA5. Tenim un llistat de pluges mensuals. Mostra els següents resultats.
#llistaPluges21 = [16.5, 0.0, 32.7, 6.5, 24.6, 15.7, 2.6, 0.0, 94.2, 65.5, 25.5, 9.2]
#Calcula el total.
#Ordena la llista de valors grans a petits.
#Mostra els 3 valors més grans.
#Obtén el valor màxim i el mínim.
#Calcula la mitjana aritmètica.#

llistaPluges21 = [16.5, 0.0, 32.7, 6.5, 24.6, 15.7, 2.6, 0.0, 94.2, 65.5, 25.5, 9.2]
TotalPluges    = sum(llistaPluges21)
SortedPluges   = sorted(llistaPluges21)
Max3values     = sorted(llistaPluges21, reverse=True)[:3]
MaxAndMin      = [SortedPluges[0], SortedPluges[-1]]
MitjanaArit    = TotalPluges / len(llistaPluges21)

print(Max3values)
print(SortedPluges)
print(MaxAndMin)
print(MitjanaArit)