import re 
from pathlib import Path

# r'' -> RAW STRING: No coje los caracteres especiales

#------------------------------------------------------------------------------------------------------------------------------------------------------
def example1():

    txt: str        = 'Hola\nAdiós\nHola2\nAdiós2\nHola3\nAdiós3'
    reg: str        = r'(\w+)\n(\w+)'
    pat: re.Pattern = re.compile(reg) # Regex options
    
    match_list: list[re.Match] = list(pat.finditer(txt))

    match: re.Match = match_list[1]

    for match in match_list:
        print(F"Start:       {match.start()}")
        print(F"Endtart:     {match.end()}")
        print(F"Whole match: {match.group(0)}")
        print(F"Group 1:     {match.group(1)}")
        print(F"Group 2:     {match.group(2)}")
        print('----------------------------------------------------------------')

#------------------------------------------------------------------------------------------------------------------------------------------------------
def sub_example():

    txt: str        = 'Hola\nAdiós\nHola2\nAdiós2\nHola3\nAdiós3'
    reg: str        = r'Hola'
    pat: re.Pattern = re.compile(reg) # Regex options
    
    new_txt: str = pat.sub('Buenaaasss!!!', txt)
    print(new_txt)
#------------------------------------------------------------------------------------------------------------------------------------------------------
def read_fasta():

    fasta: str      = Path('/bio/2023-01-23/data/example.fasta').read_text(encoding='utf-8')
    reg:   str      = r'(\w+)\n(\w+)\n(\w+)\n(\w+)'
    pat: re.Pattern = re.compile(reg) # Regex options
    
    match_list: list[re.Match] = list(pat.finditer(fasta))

    match_list.pop(0)

    line_list: list[str] = [match.group(0) for match in match_list]

    result = ''.join(line_list)
    print(result)

#------------------------------------------------------------------------------------------------------------------------------------------------------
def main():

    #example1()
    #sub_example()
    read_fasta()

if __name__ == '__main__':
    main()


