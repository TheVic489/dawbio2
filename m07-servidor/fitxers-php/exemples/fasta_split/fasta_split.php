<?php
// test
/* Program to split fasta file with different sequencies into several fasta files */
  //path and filename definitions.
  $path = "./files/";
  $inputFile = "sequence.fasta";

  //assess file existance
  if (!file_exists($path . $inputFile)) {
      exit("File not found");
  }

  //read file into an array of lines
  $lines = file($path . $inputFile);

  //process lines
  $fileOpen = false; //flag to check if output file is open.
  foreach ($lines as $line) {
    $firstChar = $line[0];   //get first character of line.
    if ($firstChar === '>') {  //is a header line?
      if ($fileOpen) {  //if not the first set of data, close previous file.
        fclose($out);
        $fileOpen = false;
      }
      //get last word of header line and use it as file name.
      $words = explode(" ", $line);
      $outputFile = trim($words[2]) . ".fasta";
      //open output file.
      $out = fopen($path . $outputFile, "w");
      $fileOpen = true;
      echo "<h3>Opening file $outputFile</h3>";   
    }
    else  {  //not the header line, so write line to file.
      fputs($out, $line); 
      echo "<p>Writing to file $outputFile line:</p>";
      echo $line;     
    }

  }
