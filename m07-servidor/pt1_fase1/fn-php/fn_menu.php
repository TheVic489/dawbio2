<?php
/**
 * Get categories from file
 * @return array with the data of categories.txt
 */
function get_categories(): array {
    $filename = "../files/categories.txt";
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

$categories_array = get_categories();
var_dump($categories_array);

/**
 * Get array of courses of desired category.
 * @return array of courses of category
 */
function get_courses_by_categories(string $cat): array {
    $filename = "../files/menu.txt";
    $delimiter = ";";
    $result = [];
    
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
                        array_push($result, $name);
                    }
                }
            }
            \fclose($handle);            
        }
    }  
    return $result;
}

var_dump(get_courses_by_categories('drink'));



?>