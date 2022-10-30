# Imports
import pandas  as pd

# -----------------------------------------------------------------------------
# Student name: WRITE YOUR NAME HERE
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: get_tuberculosis_deaths()
# -----------------------------------------------------------------------------
# 
# - You are given the fixed Tycho dataset.
# - Write a function to answer this question:
#   - Plot the deaths caused by tuberculosis in these states: New York, California
#   - and Texas in year 1897.
# 
# - Entry parameters:
#   - The dataframe with all entries.
#   - 
# - Return parameters:
#   - Return a dataframe.
#   - The dataframe must have the following columns in the same order:
#     week, NY_deaths, CA_deaths, IL_deaths
#   - The week column must start from 1 and end in 52.
# 
# - Hint:
#   - The easiest way to group the data is create a dataframe with the epi_week and num_deaths
#   - of each state and then create a new dataframe.
#   - Check the q4_diseases_example.pdf to see how should look the resulting plot.
# 
# - Remember:
#   - Write your solution inside the given function.
#   - Functions must be pure. Remember to delete your print() calls when done.
#   - Run pytest to make sure you succeeded.
# -----------------------------------------------------------------------------


# - Write your solution here.
# - This function must be pure. Remember to delete your print() calls when done.
# ------------------------------------------------------------------------------------
def get_state_disease_mask(disease: str, state: str):
    return (entries.loc[ : ,'disease'] == disease) & (entries.loc[ : ,'state'] == state)


def get_tuberculosis_deaths(entries: pd.DataFrame) -> pd.DataFrame:
    
    # Another HINT. Filter records with disease TUBERCULOSIS in NY.
    tuberculosis_NY_mask = get_state_disease_mask('TUBERCULOSIS','NY')
    diseases: pd.DataFrame = (entries)

    return diseases


# Main
# ------------------------------------------------------------------------------------
if __name__ == "__main__":

    entries:    pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")
    # Filter records by year.
    entries = entries.query('year == 1897')
    diseases:   pd.DataFrame = get_tuberculosis_deaths(entries)

    #diseases.set_index('week', drop=True).plot(kind='line', title='Tuberculosis deaths in 1897').get_figure().savefig("output/diseases2.pdf")
    print(diseases)

# -----------------------------------------------------------------------------