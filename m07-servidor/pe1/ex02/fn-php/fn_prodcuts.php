<?php

/**
 * Get all prodcuts  from file
 * @param string filename filepath where is .txt file
 * @return array with the data of categories.txt
 */
function get_products(string $filename): array
{
    $delimiter = ";";
    $result = [];
    $prodcut_array = [];

    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            $firstline = fgets($handle, 4096);
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $product);
                if ($product) {
                    list($name, $price) = \explode($delimiter, $product);
                        $prodcut_array = [$name, $price];
                        array_push($result, $prodcut_array);
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
        echo "<table class='table table-hover'>";
        // 1st row: title
        echo "<tr>";
        echo "<th scope='col' colspan='1'>Producte</th>";
        echo "<th scope='col' colspan='4'>Preu</th>";
        echo "<th scope='col' colspan='2'>Cuantitat</th>";
        echo "</tr>";

        echo "<tr rowspan='3'>";
        foreach($array_course as $dishes) {
        echo "<br>";
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
