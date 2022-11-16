<?php

function varDumpPre(mixed $var) {
    echo "<pre>";
    \var_dump($var);
    echo "</pre>";
}


//main path
//get data received from form, sanitize and validate them
if (isset($_POST['submit'])) {  //check if form has been sent.

    $fname_input = \filter_input(\INPUT_POST, 'fname_input', \FILTER_SANITIZE_STRING);
    $fname_input = \filter_var($fname_input, \FILTER_SANITIZE_STRING);

    $lname_input = \filter_input(\INPUT_POST, 'lname_input', \FILTER_SANITIZE_STRING);
    $lname_input = \filter_var($lname_input, \FILTER_SANITIZE_STRING);

    $fname_upper = ucfirst($fname_input);
    $lname_upper = ucfirst($lname_input);

    $full_name = $fname_upper . " " . $lname_upper;
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form sample</title>
    <style>
        .related label {
            vertical-align: top;
        }
        h2 {
            background-color: lightgray;
        }
        div.labelinput {display: block; clear: both; margin: 10px; border: 5px;}
        label {display: inline; float: left; min-width: 15em; border: 5px;}
        input, span {display: inline; float: left;}
    </style>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

        <fieldset>
            <legend>Excercici 1</legend>


            
            <div class="labelinput">
                <label for="form_text">Cognom :</label>
				<input type="text" name="lname_input" value="<?php echo $lname_input ?? ""; ?>"size="20" minlength="3" required placeholder="Input text here"/>
				<!--               name = (Variable que agafarà el servidor)                                                  -->
            </div>

            <div class="labelinput">
                <button type="submit" name="submit" value="sent">Submit</button>
                <input type="reset" value="Reset">

            </div>
        </fieldset>

        <fieldset>
            <legend>Result</legend>
            <div class="labelinput">
                <label for="fname_input">Name: </label>
                <label type="text" name="fname_input"><?php echo $fname_input ?? ""; ?></label>
            </div>
            <div class="labelinput">
                <label for="lname_input">Cognom: </label>
                <label type="text" name="lname_input"><?php echo $lname_input ?? ""; ?></label>
            </div>

        </fieldset>

        <fieldset>
            <legend>Formated Name</legend>
            <div class="labelinput">
                <h3 for="full_name"><?php echo $full_name ?? ""; ?></h3>
            </div>
        </fieldset>
    </form>
</body>
</html>