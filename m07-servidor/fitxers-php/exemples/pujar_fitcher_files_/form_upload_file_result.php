<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>DNA form result</title>
    </head>
    <body>
        <h1>DNA form result</h1>
        <pre><?php var_dump($_FILES);?></pre>
        <?php
        //path where uploaded files should be copied.
        define("PATH_TO_UPLOADED_FILES", "img/");
        /* Retrieve data from the query */
        if (filter_has_var(INPUT_POST, 'form_submit')) {
            $sequence_name = filter_input(INPUT_POST, 'sequence_name', FILTER_SANITIZE_STRING);
            $sequence = filter_input(INPUT_POST, 'sequence', FILTER_SANITIZE_STRING);
            $sequence_type = filter_input(INPUT_POST, 'sequence_type', FILTER_SANITIZE_STRING);

            //error container (string)
            $errors = "";
            //validations.
            if (trim($sequence_name) === "") {
                $errors = $errors . "<li>Sequence name required.</li>";
            }
            if (trim($sequence) === "") {
                $errors = $errors . "<li>Sequence required</li>";
            }
            if (trim($sequence_type) === "") {
                $errors = $errors . "<li>Sequence type required.</li>";
            }
            if ($_FILES['filename']['error'] == UPLOAD_ERR_FORM_SIZE) {
                $errors = $errors . "<li>Max file size exceeded.</li>";
            }
            //show errors.
            if ($errors != "") {
                echo "<p>Errors:</p>";
                echo "<ul>", $errors, "</ul>";
                echo "<p>[<a href='form_upload_file.php'>DNA form</a>]</p>";
            } else {
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    echo "File ". $_FILES['filename']['name'] ." uploaded successfully.\n";
                    // get MIME type
                    $mime_type = mime_content_type($_FILES['filename']['tmp_name']);
                    echo "<p>MIME type: $mime_type</p>";
                    // If you want to allow certain files
                    $allowed_file_types = ['image/png', 'image/jpeg', 'application/pdf'];
                    if (! in_array($mime_type, $allowed_file_types)) {
                        // File type is NOT allowed
                        echo "<p>File type not allowed</p>";
                    } else {
                        // Set up destination of the file
                        $destination = PATH_TO_UPLOADED_FILES . basename($_FILES["filename"]["name"]);
                        echo "destination: $destination";
                        // Now you move/upload your file
                        if (move_uploaded_file($_FILES['filename']['tmp_name'], $destination)) {
                            echo "<p>File successfully uploaded and moved</p>";
                        }
                    }
                } else {
                    echo "File ". $_FILES['filename']['name'] ." NOT uploaded.\n";
                }
//show retrieved data.              
echo <<<EOT
<ul>
<li>$sequence_name</li>
<li>$sequence</li>
<li>$sequence_type</li>
</ul> 
EOT;
                echo "<p><img src=\"$destination\" alt='NO IMAGE' /></p>";
                //link to form.
                echo "<p>[<a href='form_upload_file.php'>DNA form</a>]</p>";
            }
        } else {
            echo "<p>Form has not been sent</p>";
        }
        ?>

    </body>
</html>