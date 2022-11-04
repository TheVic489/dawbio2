# Imports
import pandas  as pd
import q3_sol

# -----------------------------------------------------------------------------
# Test: test_get_ambiguous_cities()
# -----------------------------------------------------------------------------

# -----------------------------------------------------------------------------
def test_get_ambiguous_cities():

    # Read input and correct result
    entries:            pd.DataFrame = pd.read_csv("data/tycho-fixed.csv", sep=",")
    q3_epiweeks_not7days:   pd.DataFrame = pd.read_csv("output/q3_epiweeks_not7days.csv", sep=",")

    # Get result
    result: pd.DataFrame = q3_sol.q3_epiweeks_not7days(entries)

    # Test
    pd.testing.assert_frame_equal(result, q3_epiweeks_not7days)


# -----------------------------------------------------------------------------
