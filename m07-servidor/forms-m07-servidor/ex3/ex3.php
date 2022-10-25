<?php

function varDumpPre(mixed $var)
{
    echo "<pre>";
    \var_dump($var);
    echo "</pre>";
}

// 3.Programar una aplicació que permeti introduir el nom d'una persona i 
// seleccionar amb un checkbox els esports que practica (d'entre una llista d'esports disponibles). 
// Un cop enviat el formulari, un contenidor mostrarà la informació del nom i una llista amb els esports que practica.

if (isset($_POST['submit'])) {  //check if form has been sent.

    $name_input = \filter_input(\INPUT_POST, 'name_input', \FILTER_SANITIZE_STRING);
    $name_input = \filter_var($name_input, \FILTER_SANITIZE_STRING);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form sample server</title>
    
</head>

<body>
    <h1>Ex3: Sports Form</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend>Your name</legend>
            <div class="labelinput">
                <label for="form_text">Nom :</label>
                <input type="text" name="name_input" value="<?php echo $name_input ?? ""; ?>" size="20" minlength="3" required placeholder="Input text here" />
                <!--               name = (Variable que agafarà el servidor)                                                  -->
            </div>
        </fieldset>

        <fieldset>
            <legend>Select sports</legend>
            <div class="related">
                <label for="form_checkbox[]">Click multiple options:</label>
                <input type="checkbox" name="form_checkbox[]" value="Football" /> Football
                <input type="checkbox" name="form_checkbox[]" value="Baskeball" /> Baskeball
                <input type="checkbox" name="form_checkbox[]" value="Tenis" /> Tenis
                <input type="checkbox" name="form_checkbox[]" value="Volleyball" /> Volleyball
                <input type="checkbox" name="form_checkbox[]" value="Badminton" /> Badminton

            </div>
        </fieldset>
        <button type="submit" name="submit" value="sent">Submit</button>
        <fieldset>
            <legend>Result</legend>
            <h3 for="name_input"><?php echo $name_input ?? ""; ?></h3>
            <ul>
                <?php
                if (isset($_POST['submit'])) {  //check if form has been sent.
                    $form_checkbox = filter_input(INPUT_POST, 'form_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                    if (isset($form_checkbox)) {
                        foreach ($form_checkbox as $checkbox_values) {
                            echo "<li>", $checkbox_values, "</li>";
                        }
                    } else {
                        echo "<p>Select an option please.</p>";
                    }
                }
                ?>
            </ul>
        </fieldset>
    </form>
</body>

</html>