<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form sample server</title>
</head>
<body>
<h1>Form sample result</h1>
            <?php
            if (((!filter_has_var(INPUT_POST, 'form_submit')))) {
                echo "<p>Form has not been submitted!</p>";
                die;
            }
            ?>
            <h2>text</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_text'), "</p>";
            ?>
            
            <h2>radio</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_radio'), "</p>";
            ?>
            
            <h2>checkbox</h2>
            <?php
                $form_checkbox = filter_input(INPUT_POST, 'form_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                if (isset($form_checkbox)) {
                    foreach ($form_checkbox as $checkbox_values) {
                        echo "<p>", $checkbox_values, "</p>";
                    }                        
                } else {
                    echo "<p>Checkbox not set</p>"; 
                }
            ?>
            
            <h2>hidden</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_hidden'), "</p>";
            ?>
            
            <h2>password</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_password'), "</p>";
            ?>
                  
            <h2>select simple</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_select'), "</p>";
            ?>
            
            <h2>select multiple</h2>
            <?php
                if (isset($_POST['form_multiselect'])) {
                    foreach ($_POST['form_multiselect'] as $select_values) {
                        echo "<p>", $select_values, "</p>";
                    }
                }
            ?>
            
            <h2>textarea</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_textarea'), "</p>";
            ?>

            <h2>color</h2>
            <?php
                echo "<p>", filter_input(INPUT_POST, 'form_color'), "</p>";
            ?>

            <h2>button</h2>
            <?php
                $buttonValue = filter_input(INPUT_POST, 'form_button');
                if (isset($buttonValue)) {
                    echo "<p>", "'BUTTON FORM' has been clicked", "</p>";
                }
                else {
                    echo "<p>", "'BUTTON FORM' has not been clicked", "</p>";	
                }
            ?>
            
            <h2>submit</h2>
            <?php
                $submitValue = filter_input(INPUT_POST, 'form_submit');
                if (isset($submitValue)) {
                    echo "<p>", "'SUBMIT FORM' has been clicked", "</p>";
                }
            ?>

            <h2>Debugging values</h2>
            <?php
               echo '<p>var_dump( $_POST )</p>';
               var_dump ( $_POST );
               echo '<p>print_r( $_POST )</p>';
               print_r( $_POST );
            ?>
            </p>
    
</body>
</html>