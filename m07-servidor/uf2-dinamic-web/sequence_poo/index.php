<?php
require_once 'GeneticSequence.php';
require_once 'DnaSequence.php';
require_once 'RnaSequence.php';
require_once 'SequenceUtil.php';

$objDnaSequence = new DnaSequence("SEQ_DNA","ACGTACGTACGT");

//echo ($objDnaSequence->validate()) ? "<p>VALID</p>" : "<p>INVALID</p>";

if ($objDnaSequence->validate()) {
    echo "<p>VALID</p>";
}
else {
    echo "<p>INVALID</p>";
}

echo "ID: " . $objDnaSequence->getId();
echo "<br/>";
echo " ELEMENTS: " . $objDnaSequence->getElements();


echo "<br/><br/>";
$objRnaSequence=$objDnaSequence->transcription("SEQ_RNA");

//echo $objRnaSequence;

echo "ID: " . $objRnaSequence->getId();
echo "<br/>";
echo " ELEMENTS: " . $objRnaSequence->getElements();

echo "<br/><br/>";
$objDnaSequenceNew=$objRnaSequence->transcription("SEQ_DNA_NEW");

echo "ID: " . $objDnaSequenceNew->getId();
echo "<br/>";
echo " ELEMENTS: " . $objDnaSequenceNew->getElements();

//echo $objDnaSequenceNew->getElements();

echo "<br/>";

print_r($objDnaSequenceNew->countBases());


echo SequenceUtil::generateRandomSequence("ACGT", 10);

