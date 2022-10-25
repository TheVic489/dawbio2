<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'php-fn/file-fn.php';
            use proven\files as files;
            $filepath = 'files/data.txt';
            $delimiter = ':';
            $majorityAge = 18;
            $dataRead = files\readPropertiesFile($filepath, $delimiter);
            /*
            $adultList = array();
            foreach ($dataRead as $name => $age) {
                if ((int)$age > $majorityAge) {
                    $adultList[] = $name;
                }
            }
             */
            $adultList = \array_filter($dataRead, function($value) {return ((int)$value > 18);});
            echo "Adults: " . \json_encode($adultList);
        ?>
    </body>
</html>
