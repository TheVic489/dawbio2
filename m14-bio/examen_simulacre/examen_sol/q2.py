# Imports
import pandas  as pd

# -----------------------------------------------------------------------------
# Student name: WRITE YOUR NAME HERE
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: get_total_deaths()
# -----------------------------------------------------------------------------
# 
# - You are given the fixed Tycho dataset.
# - Write a function to view the ranking of diseases by number of total deaths. 
# - Additionally, create a new field that calculates the percent of deaths  
# - of each diseases compared to the total of deaths.
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
    return ranking_deaths


# Main
# -----------------------------------------------------------------------------
if __name__ == "__main__":

    entries: pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")
    
    ranking_deaths:  pd.DataFrame = get_total_deaths(entries)
    ranking_deaths.to_csv("output/q2_ranking_deaths.csv", sep=",", index=False)
    print(ranking_deaths)


# -----------------------------------------------------------------------------
