<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shapes example</title>
    </head>
    <body>
<?php
require_once 'classes/Shape.php';
require_once 'classes/Circle.php';
require_once 'classes/Square.php';
use shapes\Shape, shapes\Circle, shapes\Square;

// methods

/**
 * prints information about a shape
 * @param Shape $shape
 */
function printShapeInfo(Shape $shape) {
    echo sprintf("<li>%s. perimeter=%.2f, area=%.2f</li>", $shape, $shape->perimeter(), $shape->area());
}

/**
 * prints a list of shapes
 * @param Shape $shapeList
 */
function printShapes(array $shapeList) {
    echo "<p>Printing ", count($shapeList), " elements</p>";
    echo "<ul>";
    foreach ($shapeList as $elem) {
        printShapeInfo($elem);
    }
    echo "</ul>";
}

//define a list of shapes.
$myShapes = array();
//populate the list with new shapes.
$myShapes[] = new Circle(3.0);
$myShapes[] = new Square(3.0);
//print shapes information.
printShapes($myShapes);
?>
    </body>
</html>
