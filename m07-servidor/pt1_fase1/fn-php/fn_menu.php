<?php

/**
 * Get categories from file
 * @param string filename filepath where is .txt file
 * @return array with the data of categories.txt
 */
function get_categories(string $filename): array
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
 * Get array of courses of desired category.
 * @param string cat category name to searh
 * @param string filename filepath where is .txt file
 * @return array of courses of category
 */
function get_courses_by_categories(string $cat, string $filename): array
{
    $delimiter = ";";
    $result = [];
    $course_array = [];

    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            $firstline = fgets($handle, 4096);
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $course);
                if ($course) {
                    list($id, $category, $name, $price) = \explode($delimiter, $course);
                    if ($cat == $category) {
                        $course_array = [$id, $name, $price];
                        array_push($result, $course_array);
                        // array_push($result, $id, $name, $price);
                    }
                }
            }
            \fclose($handle);
        }
    }
    return $result;
}


/**
 * Get array of courses if desired file .
 * @param string cat category name to searh
 * @param string filename filepath where is .txt file
 * @return array of courses of category
 */
function get_menu(string $cat, string $filename): array
{
    $delimiter = ";";
    $result = [];
    $course_array = [];

    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            $firstline = fgets($handle, 4096);
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $course);
                if ($course) {
                    list($id, $category, $name) = \explode($delimiter, $course);
                    if ($cat == $category) {
                        $course_array = [$id, $category, $name];
                        array_push($result, $course_array);
                        // array_push($result, $id, $name, $price);
                    }
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
function printTable(array $array) {
    foreach ($array as $array_course) {
        echo "<div>";
        echo "<table>";
        // 1st row: title
        echo "<tr>";
        echo "<th colspan='3'>ID</th>";
        echo "<th colspan='3'>Category</th>";
        echo "<th colspan='3'>name</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>", $array_course[0], "</td>";
        echo "<td>", $array_course[1], "</td>";
        echo "<td>" ,$array_course[2], "</td>";
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
