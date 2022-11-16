# Imports
import pandas  as pd

# -----------------------------------------------------------------------------
# Student name: VICTOR PIÑANA CORTES
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: get_total_deaths()
# -----------------------------------------------------------------------------
# 
# - You are given the fixed Tycho dataset.
# - Write a function to view the ranking of diseases by number of total deaths. 
# - Additionally, create a new field that calculates the percent of deaths  
# - of each diseases compared to the total of deaths in this year.
# 
# - Return parameters:
#   - Return a dataframe.
#   - The dataframe must have 4 columns in this order: ranking, disease, num_deaths, pct_deaths
#   - The ranking must start at 1
#   - The index must be numerical, starting from 0.
# 
# - Hint:
# - A Percentage is calculated by the mathematical formula of dividing the value by the sum of 
# - all the values and then multiplying the sum by 100. 
# - This is also applicable in Pandas Dataframes. 
# - The pre-defined sum() method of pandas series is used to compute the sum 
# - of all the values of a column.
# 
# - Remember:
#   - Write your solution inside the given function.
#   - Functions must be pure. Remember to delete your print() calls when done.
#   - Run pytest to make sure you succeeded.
# -----------------------------------------------------------------------------


# - Write your solution here.
# - This function must be pure. Remember to delete your print() calls when done.
# -----------------------------------------------------------------------------
def get_total_deaths(entries: pd.DataFrame) -> pd.DataFrame:

    ranking_deaths: pd.DataFrame = (entries)
    # Group by disease and sum all columns
    ranking_deaths = ranking_deaths.groupby('disease', as_index=False).sum()

    # Creating pct_deaths column
    ranking_deaths['pct_deaths'] = (ranking_deaths['num_deaths'] / entries['num_deaths'].sum()*100)

    # Creating Rank column
    ranking_deaths['Ranking'] = ranking_deaths['num_deaths'].rank(ascending=False)
    ranking_deaths['Ranking'] = ranking_deaths['Ranking'].astype(int)

    # Sorting by num_deaths, and show this columns 
    ranking_deaths = ranking_deaths[['Ranking', 'disease', 'num_deaths', 'pct_deaths']].sort_values(by='num_deaths', ascending=False)

    # Fixing index
    ranking_deaths.reset_index(drop=True, inplace=True)
    

    return ranking_deaths


# Main
# -----------------------------------------------------------------------------
if __name__ == "__main__":

    entries: pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")
    
    ranking_deaths:  pd.DataFrame = get_total_deaths(entries)
    print(ranking_deaths)


# -----------------------------------------------------------------------------
