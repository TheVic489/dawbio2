# Imports
import pandas  as pd

# -----------------------------------------------------------------------------
# Student name: WRITE YOUR NAME HERE
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: fix_broken_tycho()
# -----------------------------------------------------------------------------
# 
# - You are given a broken Tycho dataset. Write a function to fix it.
# - The function fix_broken_tycho() must do the following:
#   1. Drop 'country' and 'url' columns
#   2. Cleanup the diseases removing the descriptions in square brackets, we don't need it. (See hint below)
#   3. Add a new column called 'year' of type 'int' with the year from the epi_week.
#   4. Select rows where the year is 1896, 1897, 1898.
#   5. Add a new column called 'id' with a numerical unique identifier starting from 0
#   6. Rename 'loc' to 'city', 'number' to 'num_deaths'
#   7. Reorder columns as follows: ['id', 'year', 'epi_week', 'from_date', 'to_date', 'state', 'city', 'disease', 'num_deaths']
# 
# - Return parameters:
#   - Return the fixed entries as a dataframe.
#   - The index must be numerical, starting from 0.
# 
# - Hints:
#   Step2.
#   <dataframe>.str.replace(pat=r' \[.*\]', repl='', regex=True)
#   Step4. You can use masks or this function:
#   <dataframe>.query( min_year <= year <= max_year )
# 
# - Remember:
#   - Write your solution inside the given function.
#   - Functions must be pure. Remember to delete your print() calls when done.
#   - Run pytest to be sure you succeeded.
# -----------------------------------------------------------------------------


# -----------------------------------------------------------------------------
def get_year(epi_week: int) -> int:

    epi_week_str: str = str(epi_week)
    year_str:     str = epi_week_str[0:4]
    year_int:     int = int(year_str)

    return year_int

# -----------------------------------------------------------------------------
def fix_broken_tycho(entries: pd.DataFrame) -> pd.DataFrame:

    new_disease_format:  str  = r' \[.*\]'
    sorted_columns: list[str] = ['id', 'year', 'epi_week', 'from_date', 'to_date', 'state', 'city', 'disease', 'num_deaths']

    ## Fixing steps 1 and 6: delete and rename columns.
    fixed_entries: pd.DataFrame = (entries.drop(  columns=['country', 'url'])
                                          .rename(columns={'loc': 'city', 'number': 'num_deaths'})                               
    )

    ## Fixing step 2. Renaming the disease column. 
    fixed_entries.loc[:,'disease'] = fixed_entries.loc[:,'disease'].str.replace(pat=r' \[.*\]', repl='', regex=True)

    ## Fixing step 3. Create Year colunm, assigning the first 4 characters of epi_week field.
    fixed_entries.loc[:,'year'] = fixed_entries.loc[:,'epi_week'].map(get_year)

    ## Fixing step 4. Select rows where the year is 1896, 1897, 1898.
    years_range_mask = (fixed_entries.loc[ : , 'year' ] > 1895) & (fixed_entries.loc[ : , 'year'] < 1899)
    # We apply the mask in all rows.
    fixed_entries = fixed_entries.loc[years_range_mask, : ]
                            
    ## Fixing step 5 ans 7 Add a new column called 'id' with a numerical unique identifier starting from 0
    ## and reassign dataframe fields.
    fixed_entries = fixed_entries.reset_index(drop=True).assign(id=lambda df: df.index)
    fixed_entries = fixed_entries.reindex(columns=sorted_columns)

    return fixed_entries


# Main
# -----------------------------------------------------------------------------
if __name__ == "__main__":

    broken_entries: pd.DataFrame = pd.read_csv("data/tycho-broken22.csv", sep=",")
    fixed_entries:  pd.DataFrame = fix_broken_tycho(broken_entries)
    
    fixed_entries.to_csv("data/tycho-fixed22.csv", sep=",", index=False)
    print(fixed_entries.head(20))

# -----------------------------------------------------------------------------
