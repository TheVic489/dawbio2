<?php

namespace proven\htmldom;

/**
 * echoes html code for a select element with values given in array parameter
 * @param name the name for the selector element
 * @param array the array of values for the selector 
 */
function renderSelector(string $name, array $values, mixed $valueSel = "") {
    echo "<select name=\"$name\">\n";
    foreach ($values as $value) {
        $selected = ($value == $valueSel) ? "selected='selected'" : "";
        echo "<option value=\"$value\" $selected>$value</option>\n";
    }
    echo "</select>\n";
}

