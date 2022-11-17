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

    # Filter records with disease TUBERCULOSIS.
    tuberculosis_NY_mask = get_state_disease_mask('TUBERCULOSIS','NY')
    sum_diseases_NY: pd.DataFrame = (entries.loc[tuberculosis_NY_mask,['epi_week', 'num_deaths']]
                        .groupby(by=['epi_week']).sum()
    )
    #print(sum_diseases_NY)

    tuberculosis_CA_mask = get_state_disease_mask('TUBERCULOSIS','CA')
    sum_diseases_CA: pd.DataFrame = (entries.loc[tuberculosis_CA_mask,['epi_week', 'num_deaths']]
                .groupby(by=['epi_week']).sum()
    )
    #print(sum_diseases_CA)

    tuberculosis_IL_mask = get_state_disease_mask('TUBERCULOSIS','IL')
    sum_diseases_IL: pd.DataFrame = (entries.loc[tuberculosis_IL_mask,['epi_week', 'num_deaths']]
                .groupby(by=['epi_week']).sum()
    )
    #print(sum_diseases_IL)

    diseases_by_epiweek: pd.DataFrame = pd.DataFrame(
                            index=sum_diseases_NY.index,
                            data={
                                'NY_deaths':  sum_diseases_NY.num_deaths,
                                'CA_deaths':    sum_diseases_CA.num_deaths,
                                'IL_deaths': sum_diseases_IL.num_deaths
                            }
    )

    diseases = (diseases_by_epiweek.reset_index(drop=True)
                                    .assign(week=lambda df: df.index + 1)
                                    .fillna(0)
                                    .reindex(columns=['week', 'NY_deaths', 'CA_deaths', 'IL_deaths'])
    )

    ## diseases_by_epiweek.assign(week=lambda df: df.index + 1)

    return diseases


# Main
# ------------------------------------------------------------------------------------
if __name__ == "__main__":

    entries:    pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")
    # Filter records by year.
    entries = entries.query('year == 1897')
    diseases:   pd.DataFrame = get_tuberculosis_deaths(entries)

    diseases = diseases.set_index('week', drop=True)
    diseases.plot(kind='line', title='Tuberculosis deaths in 1897').get_figure().savefig("output/diseases2.pdf")
    diseases.to_csv("output/q4_diseases.csv", sep=",")


# -----------------------------------------------------------------------------
# - curiositat. https://en.wikipedia.org/wiki/1900_United_States_census#Census_questions