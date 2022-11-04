# Imports
import pandas  as pd
import q2_sol

# -----------------------------------------------------------------------------
# Test: test_get_total_deaths()
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
def test_get_total_deaths():

    # Read input and correct result
    entries:  pd.DataFrame = pd.read_csv("data/tycho-fixed.csv",  sep=",")
    deaths:   pd.DataFrame = pd.read_csv("output/q2_ranking_deaths.csv", sep=",")

    # Get result
    result: pd.DataFrame = q2_sol.get_total_deaths(entries)

    # Test
    pd.testing.assert_frame_equal(result, deaths)


# -----------------------------------------------------------------------------
