<?php
namespace proven\files {
    
    /**
     * 
     * @param type $filename the name of the file to be read.
     * @param type $delimiter the separator between keys and values.
     * @return associative array with the data read from the file.
     */
    function readPropertiesFile($filename, $delimiter) {
        $data = array();
        if (\file_exists($filename) && \is_readable($filename)) {
            $handle = \fopen($filename, 'r');  //returns false on error.
            if ($handle) {
                while (!\feof($handle)) {
                    $line = \fgets($handle);
                    if ($line) {
                        list($key, $value) = \explode($delimiter, $line);
                        $data["$key"] = (int) $value;
                    }
                }
                \fclose($handle);            
            }
        }
        return $data;
    }

}