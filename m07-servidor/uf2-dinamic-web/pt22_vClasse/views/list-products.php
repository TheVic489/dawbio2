<h2>List of all products</h2>
<?php
//TODO
$prodList = $params['prodList']??array();
$message = $params['message']??'';
if (count($prodList)==0) {
    echo "No data found";
}
echo $message;
var_dump($prodList);


