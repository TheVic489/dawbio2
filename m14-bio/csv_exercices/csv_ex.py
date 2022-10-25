# Import notebook
# How to import a notebook a file
from nis import cat
from pathlib import Path
import csv
import utils

# How to define a function in python with the word key
# the type date after the : is only documentation for Python
def read_csv_file(csv_file_path: str) -> list:
    
    with open(csv_file_path, newline='') as csvfile:
        csv_reader=csv.DictReader(csvfile, delimiter=";")
        result = [row_dict for row_dict in csv_reader]
        
    return result


csv_file_path = "scimago-medicine.csv"
entries = read_csv_file(csv_file_path)
print(entries[3])


# Exercici 1 How many entries are in scimago-medicine.csv?
print(len(entries))

#Exercici2 Show the first 25 entries.
print(entries[0:25])


#Exercici3 Compta el número d'entrades publicades a Espanya en una llista (Country = Spain)
numEntrySpain: int = 0 
for entry in entries:
    if entry['Country'] == 'Spain':
        numEntrySpain += 1

print(numEntrySpain)


# Exercici4 - Mostra les revistes (Type = journal) publicades 
# - a UK (Country = United Kingdom) 
# - i que tinguin un H index superior a 200.
for entry in entries:
    if entry['Type'] == 'journal' and entry['Country'] == 'United Kingdom'and int(entry['H index']) > 200 :
        print(entry)

# Solucio FUNCIONAL.
def filterUKJournalHIndex300 (entry:dict) -> bool:      
        return entry['Country'] == 'United Kingdom' and entry['Type'] == 'journal' and int(entry['H index']) > 200   

entriesUKJournalHIndex300 = list(filter(filterUKJournalHIndex300,entries))                          
print(len(entriesUKJournalHIndex300))

#Exercici 5 What types of scientific publications are in the file ?
types_list     = [entry['Type'] for entry in entries]
set_types_list = set(types_list)
print(set_types_list)


#Exercici 6 List all the avaliable categories. Each entry can have more than one category.
# One entry can belong to one or more categories. These are separated by semicolon (;) 
# You should remove the quarter characters (Q1),(Q2)... between categories.
import re

def q6(data: list[dict[str, str]]) -> list[str]:
    "Para que los compañeros nos aman. :-D "
    
    return list( set( sum([dictionary['Categories'].split(';') for dictionary in data], [])))

def rm_quarter(category: str) -> str:
    "Returns the category string without the quarter id: (Q1), (Q2), (Q3) or (Q4)"
    " Pending apply regex. Q(*) "
    result = category
    result = re.sub(" ?\(Q\d\)", "", result)
    return result

def q6(data: list[dict[str, str]]) -> list[str]:
    return sorted(list( set( sum(
        [rm_quarter(dictionary['Categories']).split(';') 
        for dictionary in data], []))))

# print(q6_result)
q6_result = q6(entries)

#-----------------------------------------------------
# Ex6 versió 2.0

categories_set: set = set() #Millor així. Desambigua
for entry in entries:
    #Separa, en función de los delimitadores que le pongas
    ## entryCategories = entry.split(';')
    entry_categories: list[str] = entry['Categories'].split(';')
    for category in entry_categories:
        clean_category: str = rm_quarter(category)
        categories_set.add(clean_category)

categories_list: list[str] = sorted(categories_set)

print(len(categories_set))
print(categories_list)



# One entry can belong to one or more categories. These are separated by semicolon (;) 
# You should remove the quarter characters (Q1),(Q2)... between categories.
text = "python is, an easy;language; to, learn."
print(re.split('; |, ', text))
['python is', 'an easy;language', 'to', 'learn.']



#Question 7 Show all data from the category with most entries.
#**Hint: Create a dict. The keys are the entry name, the values are the number of entres **
#Expected Result
#1 - Medicine (miscellaneous) : 2447  2 - Public Health, ...



#Exercici 8 Show all data from entries of categories: "Sports Medicine" or "Sports science"

list_sports_science_entries = [entry for entry in entries 
                               if 'sports' in entry['Categories'].lower()]

print('Sports',len(list_sports_science_entries))

# Question 9 All regions covered by all entries.

regiones: dict = set() #Mejor así. Desambigua
for entrada in entries:
    regiones.add(entrada['Region'])


print("Q9 - REGIONS.")
print(regiones)

# Question 10. Mean of H-index by region.
# Pablo Solution.

# Expected Result. (moreless)
# Northern America - 65.21652816251154, Western Europe - 54.08188428706924 ...
# Africa - 17.75

import utils
import pprint

def get_h_index_avg(filter_key: object, filter_value: object, clean_entries: list[dict]) -> float:
    "Filters entries and returns their H-Index average."

    # Filter entries
    filtered_entries: list[dict] = [entry for entry in clean_entries if entry[filter_key] == filter_value]

    # Get all H-Indexes of filtered entries
    h_index_list: list[int] = [entry['H index'] for entry in filtered_entries]

    # Calcualte H-Index average
    h_index_avg: float = sum(h_index_list) / len(h_index_list)

    return h_index_avg

# -----------------------------------------------------------------------------
#Question 10: Mean of H-index by region.
def q10():
    # Get clean entries
    clean_entries: list[dict] = utils.clean_entries(entries)
    pprint.pp(clean_entries)

   # Get list of regions
    region_set:   set[str]  = {entry["Region"] for entry in clean_entries}
    region_list: list[str]  = sorted(region_set)

    # Calculate H-index average for each region
    h_index_avg_list: list[float] = [get_h_index_avg('Region', region, clean_entries) for region in region_list]

    # Create ranking
    country_ranking: dict[str, float] = dict(zip(region_list, h_index_avg_list))

    # Sort ranking
    sorted_region_ranking: list[tuple[str, float]] = utils.sort_ranking(country_ranking)

    # Print ranking.
    # pprint -> pretty data printer.
    pprint.pp(sorted_region_ranking)

print("Q10 - Mean of H-index by region.")
q10()


# Question 11 - What is the oldest publisher that is still active?
# Convert the list of dicts to a dict of lists (DataFrame-like format)

#Observation. Active publishers havce some publication in 2021. 
# for example: 1990-2021


# -----------------------------------------------------------------------------
def q11():
    
    # Get clean entries
    clean_entries: list[dict] = utils.clean_entries(entries)

    # Constants
    CURRENT_YEAR: int = 2021

    # Filter entries: Only those who are still publishing
    filtered_entries: list[dict] = [entry for entry in clean_entries
                                    if get_last_year(entry) == CURRENT_YEAR]

    # Get oldest entry
    first_year_list:    list[int] = [get_first_year(entry) for entry in filtered_entries]
    oldest_year:        int       = min(first_year_list)
    oldest_entry_index: int       = first_year_list.index(oldest_year)
    oldest_entry:       dict      = filtered_entries[oldest_entry_index]

    # Print
    pprint.pp(oldest_entry)
    pprint.pp(oldest_entry['Publisher'])

print("11 - What is the oldest publisher that is still active?")
# q11()
