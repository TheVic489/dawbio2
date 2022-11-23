<?php

/**
 * Get all prodcuts  from file
 * @param string filename filepath where is .txt file
 * @return array with the data of categories.txt
 */
function get_products(string $filename): array
{
    $result = [];
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $cat);
                if ($cat) {
                    array_push($result, $cat);
                }
            }
            \fclose($handle);
        }
    }
    return $result;
}

/**
 * prints a table with 3 values of each array 
 * @param array  array of array
 */
function printTable(array $array)
{
    foreach ($array as $array_course) {
        echo "<div>";
        echo "<table>";
        // 1st row: title
        echo "<tr>";
        echo "<th scope='col' colspan='3'>ID</th>";
        echo "<th scope='col' colspan='3'>Category</th>";
        echo "<th scope='col' colspan='3'>name</th>";
        echo "</tr>";

        echo "<tr scope='row'>";
        foreach($array_course as $dishes) {
        echo "<td>", $dishes , "</td>";
        }
        echo "</tr>";

        echo "</table>";
        echo "</div>";
    }
}

// Degug funciton
function debug($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
