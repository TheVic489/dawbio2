import entrez
import json
from Bio import Entrez
import pprint
Entrez.email = 'victorpinana489@gmail.com'

# handle = Entrez.einfo()
# res    = handle.read()
# handle.close()

# print(res)
# type(handle)

file_handle = open('entrez.py', 'w')
type(file_handle)
file_handle.close()

# EInfo: Get the list of Entrez databases in a dictionary
with Entrez.einfo() as response:
    dbs_xml_str = response.read()
print(dbs_xml_str)

# EInfo: Get the list of Entrez databases in a dictionary
with Entrez.einfo() as response:
    dbs_dict = Entrez.read(response)

print(dbs_dict)
print((dbs_dict).keys())  # Only one key : dblist
print(dbs_dict['DbList']) # Array of strings

# The XML or JSON formats can be stored to a file in disk for 
#JSON:  
with Entrez.einfo(retmode='json') as response:
    dbs_json_str = response.read().decode('utf-8')

with open('dbs_json', 'w') as json_file:
    json_file.write(dbs_json_str)

with open('dbs_json', 'r') as json_file:
    dbs_dict_from_json = json.load(json_file)

#XML:
with Entrez.einfo(retmode='xml') as response:
    dbs_xml_str = response.read().decode('utf-8')

with open('dbs_xml', 'w') as xml_file:
    dbs_xml_bin_str = response.read()

with open('dbs_xml', 'wb') as xml_file:
    xml_file.write(dbs_xml_bin_str)




with Entrez.einfo(db="nucleotide") as response:
    nuc_db_xml_str = response.read()
    with open('nuc_db_xml', 'wb') as xml_file:
        xml_file.write(nuc_db_xml_str)

with open('nuc_db_xml', 'rb') as xml_file:
    nuc_db = Entrez.read(xml_file)

#Detailed info
print(nuc_db)
print(type(nuc_db))
print(nuc_db.keys())
print(nuc_db['DbInfo'].keys())


pp = pprint.PrettyPrinter(indent=4)
for field in nuc_db['DbInfo']['FieldList']:
    pp.pprint(field)
    print()


# Opuntia = Cactus; accD = gene
# idtype ="acc": Accession number. by default
with Entrez.esearch(db="nucleotide",
                    term="opuntia[ORGN] accD",
                    idtype="acc", 
                    retmax=10) as response:
    res= Entrez.read(response)

pprint.pprint(res)