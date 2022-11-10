# Imports
import pandas as pd

# -----------------------------------------------------------------------------
# Student name: WRITE YOUR NAME HERE
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: get_epiweeks_not7days()
# -----------------------------------------------------------------------------
# 
# - You are given the fixed Tycho dataset.
# - Write a function to answer this question:
# -  Show the number of days of each epidemical weeks of the year 1897.
# - By default, the difference between to_date and from_date is equal to 7 days,
# - but this is not always true, for several reasons (holidays, last/first week of 
# - year, days without data records...).
# 
# - Return parameters:
#   - Return a dataframe.
#   - The dataframe must show this columns: epi_week, state, from_date, to_date, difference
#   - Rows must be ordered by epi_week and state (from A to Z).
#   - The index must be numerical, starting from 0.
# 
# - Hint:
#   - use Series.dt.days method
#   - make sure from_date and to_date are converted to date format.
# 
# - Remember:
#   - Write your solution inside the given function.
#   - Functions must be pure. Remember to delete your print() calls when done.
#   - Run pytest to make sure you succeeded.
# -----------------------------------------------------------------------------


# - Write your solution here.
# - This function must be pure. Remember to delete your print() calls when done.
# -----------------------------------------------------------------------------
def get_epiweeks_not7days(entries: pd.DataFrame) -> pd.DataFrame:

    epiweeks_not7days: pd.DataFrame = ( entries )

    return epiweeks_not7days

# Main
# -----------------------------------------------------------------------------
if __name__ == "__main__":

    entries:            pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")
    epiweeks_not7days:  pd.DataFrame = get_epiweeks_not7days(entries)

    print(epiweeks_not7days)


# -----------------------------------------------------------------------------
