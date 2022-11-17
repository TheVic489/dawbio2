# Imports
import pandas as pd
from functools import reduce

# -----------------------------------------------------------------------------
# Student name: Dániel Májer
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
# Question: get_tuberculosis_deaths()
# -----------------------------------------------------------------------------
#
# - You are given the fixed Tycho dataset.
# - Write a function to answer this question:
#   - Plot the deaths caused by tuberculosis in these states: New York, California
#   - and Illinois in year 1897.
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
def get_state_disease_mask(entries: pd.DataFrame, disease: str, state: str):
    return (entries.loc[:, "disease"] == disease) & (entries.loc[:, "state"] == state)


def get_tuberculosis_deaths(entries: pd.DataFrame) -> pd.DataFrame:

    # Give "week" column to the entries.
    # =======================================================
    entries.insert(
        1, "week", entries["epi_week"].astype(str).apply(lambda x: x[4:]).astype(int)
    )
    # =======================================================

    # Get data frames for each masks and group them by week, summing the total
    # deaths for that week.
    # =======================================================
    tuberculosis_NY_mask = get_state_disease_mask(entries, "TUBERCULOSIS", "NY")
    tuberculosis_CA_mask = get_state_disease_mask(entries, "TUBERCULOSIS", "CA")
    tuberculosis_IL_mask = get_state_disease_mask(entries, "TUBERCULOSIS", "IL")

    deaths_NY: pd.DataFrame = (
        (entries.loc[tuberculosis_NY_mask])
        .groupby("week", as_index=False)
        .agg(NY_deaths=("num_deaths", "sum"))
    )

    deaths_CA: pd.DataFrame = (
        (entries.loc[tuberculosis_CA_mask])
        .groupby("week", as_index=False)
        .agg(CA_deaths=("num_deaths", "sum"))
    )

    deaths_IL: pd.DataFrame = (
        (entries.loc[tuberculosis_IL_mask])
        .groupby("week", as_index=False)
        .agg(IL_deaths=("num_deaths", "sum"))
    )
    # =======================================================

    # Merge DFs, swap NaN to 0 and reassign.
    # =======================================================
    df_merged: pd.DataFrame = reduce(
        lambda left, right: pd.merge(left, right, on=["week"], how="outer"),
        [deaths_NY, deaths_CA, deaths_IL],
    )

    df_merged = df_merged.fillna(0)

    diseases: pd.DataFrame = df_merged.copy().reset_index(drop=True)
    # =======================================================

    return diseases


# Main
# ------------------------------------------------------------------------------------
if __name__ == "__main__":

    pd.set_option("display.max_columns", None)
    entries: pd.DataFrame = pd.read_csv("data/tycho-fixed22.csv", sep=",")

    # disaeases: pd.DataFrame = pd.read_csv("output/diseases.csv", sep=",")
    # print(disaeases)

    # Filter records by year.
    entries = entries.query("year == 1897")
    diseases: pd.DataFrame = get_tuberculosis_deaths(entries)

    diseases.to_csv("./output/diseases_2.csv", index=False)
    diseases.set_index("week", drop=True).plot(
        kind="line", title="Tuberculosis deaths in 1897"
    ).get_figure().savefig("output/diseases2.pdf")

    print(diseases)

# -----------------------------------------------------------------------------
