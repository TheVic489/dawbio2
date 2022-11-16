<?php
//function library (better in a separate file)

/**
 * calculates the volume of a cylinder with the given radius and height
 * @param float $radius the radius of the cylinder
 * @param float $height the height of the cylinder
 * @return float the volume of the cylinder
 */
function cylinderVolume(float $radius, float $height): float {
    return \M_PI * $radius * $radius * $height;
}

/**
 * calculates time to fill given volume at given ratio
 * @param float $volume the volume of the recipient in m3
 * @param float $rate the filling rate in m3/h
 * @return float the time to fill in hours
 * @throws \Exception if rate is zero
 */
function fillingTime(float $volume, float $rate): float {
    if ($rate == 0.0) {
        throw new \Exception("rate is zero");
    }
    return $volume / $rate;
}

function varDumpPre(mixed $var) {
    echo "<pre>";
    \var_dump($var);
    echo "</pre>";
}

//main path
//get data received from form, sanitize and validate them, then perform calculations
if (isset($_POST['submit'])) {  //check if form has been sent.
    //sanitize and validate form data
    //cylRadius: cylinder radius
    $cylRadius = \filter_input(\INPUT_POST, 'cylRadius', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $cylRadius = \filter_var($cylRadius, \FILTER_VALIDATE_FLOAT);

    //cylHeight: cylinder height
    $cylHeight = \filter_input(\INPUT_POST, 'cylHeight', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $cylHeight = \filter_var($cylHeight, \FILTER_VALIDATE_FLOAT);

    //tapRate: tap output flow rate
    $tapRate = \filter_input(\INPUT_POST, 'tapRate', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $tapRate = \filter_var($tapRate, \FILTER_VALIDATE_FLOAT);
    
//    varDumpPre($cylRadius);
//    varDumpPre($cylHeight);
//    varDumpPre($tapRate);

    //check if all variables have passed validation after they have been sanitized
    $validData = !(($cylRadius === false) || ($cylHeight === false) || ($tapRate === false));
    
    if ($validData !== false) {  //if all data are valid
        //calculate cylinder volume
        $cylVolume = cylinderVolume($cylRadius, $cylHeight);
        try {
            //calculate filling time
            $timeLapseToCloseTap = fillingTime($cylVolume, $tapRate);
            //convert time lapse to close tap from hours to seconds
            $timeLapseToCloseTapInSeconds = \intval($timeLapseToCloseTap * 60 * 60);
            //get current datetime
            $timeToCloseTap = new \DateTime("now");  //time in hours
            $dateInterval   = new \DateInterval("PT{$timeLapseToCloseTapInSeconds}S");
            //add time lapse to current datetime
            $timeToCloseTap->add($dateInterval);
            //convert time to close tap to formatted string
            $formattedTimetoCloseTap = $timeToCloseTap->format("Y-m-d H:i:s");
        } catch (\Exception $ex) {
            //echo "<p class='error'>{$ex->getMessage()}</p>";
            $message = "Rate should not be zero";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cylinder and tap</title>
        <style>
            div.labelinput {display: block; clear: both;}
            label {display: inline; float: left; min-width: 15em;}
            input, span {display: inline; float: left}
            span {margin-left: 1em;}
            .error {display: inline; color: darkred; font-style: italic;}
            span.hidden {display: none;}
        </style>
    </head>
    <body>
        <h2>Cylinder filling calculations</h2>
        <h4>&copy;ProvenSoft 2021</h4>
        <form action="<?php echo \htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>Cylinder and tap data</legend>
                <div class="labelinput">
                    <label for="cylRadius">Cylinder radius (in meters): </label> 
                    <input type="text" name="cylRadius" value="<?php echo $cylRadius ?? ""; ?>" placeholder="input radius of the cylinder" required autofocus />
                    <span class="<?php echo ($cylRadius === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <label for="cylHeight">Cylinder height (in meters): </label>
                    <input type="text" name="cylHeight" value="<?php echo $cylHeight ?? ""; ?>" placeholder="input height of the cylinder" required />
                    <span class="<?php echo ($cylHeight === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <label for="tapRate">Tap output rate (in m<sup>3</sup>/h): </label>
                    <input type="text" name="tapRate" value="<?php echo $tapRate ?? ""; ?>" placeholder="input rate of the tap" required />
                    <span class="<?php echo ($tapRate === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <button type="submit" name="submit" value="sent">Submit</button>
                </div>
            </fieldset>
            <fieldset>
                <legend>Results</legend>
                <div class="labelinput">
                    <label for="timeLapseToCloseTap">Time until cylinder is full (in hours): </label>
                    <input type="text" name="timeLapseToCloseTap" readonly value="<?php echo $timeLapseToCloseTap ?? ""; ?>" />
                </div>
                <div class="labelinput">
                    <label for="timeToCloseTap">Close tap at time (year-month-day hh/mm/ss): </label>
                    <input type="text" name="timeToCloseTap" readonly value="<?php echo $formattedTimetoCloseTap ?? ""; ?>" />
                </div>
            </fieldset>
        </form>
        <p class="error"><?php echo $message ?? "" ?></p>
    </body>
</html>
