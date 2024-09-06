<?php
// Print statements with different cases
echo "Hello World!<br>";
echo "Hello World!<br>";
echo "Hello World!<br>";

// Display a welcome message
echo "Welcome Home!<br>";

// Variable usage
$txt = "W3Schools.com";
echo "I love $txt!<br>";

// Addition of two numbers
$x = 5;
$y = 4;
echo $x + $y . "<br>";

// Output integer and string variables
$x = 5;
$y = "John";
echo $x . "<br>";
echo $y . "<br>";

// Using global variables in a function
$x = 5;
$y = 10;

function myTest() {
    global $x, $y;
    $y = $x + $y;
}

myTest();
echo $y . "<br>";

// String variables and their types
$x = "Hello world!";
$y = 'Hello world!';

var_dump($x);
echo "<br>";
var_dump($y);
echo "<br>";

// Typecasting example
$var = "123"; 
$intVar = (int)$var;  
$floatVar = (float)$var; 
$boolVar = (bool)$var;
$arrayVar = (array)$var;  
$objectVar = (object)$var;

echo "$var  <br>";

// if-else example
$number = -5; 

if ($number > 0) {
    echo "$number is a positive number.<br>";
} elseif ($number < 0) {
    echo "$number is a negative number.<br>";
} else {
    echo "The number is zero.<br>";
}

// switch example
$dayNumber = 3;  

switch ($dayNumber) {
    case 1:
        echo "Monday<br>";
        break;
    case 2:
        echo "Tuesday<br>";
        break;
    case 3:
        echo "Wednesday<br>";
        break;
    case 4:
        echo "Thursday<br>";
        break;
    case 5:
        echo "Friday<br>";
        break;
    case 6:
        echo "Saturday<br>";
        break;
    case 7:
        echo "Sunday<br>";
        break;
    default:
        echo "Invalid day number.<br>";
        break;
}

// while loop example
$i5 = 1;

while ($i5 <= 5) {
    echo $i5 . " ";
    $i5++;
}
echo "<br>";

// do-while loop example (corrected variable check)
$i2 = 1;

do {
    echo $i2 . " ";
    $i2++;
} while ($i2 <= 5);
echo "<br>";

// Function to calculate factorial
function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

echo factorial(5) . "<br>"; 

// Function to find maximum value in an array
function findMax($array) {
    $max = $array[0];  
    foreach ($array as $value) {
        if ($value > $max) {
            $max = $value;
        }
    }
    return $max;
}

echo findMax(array(3, 1, 8, 4, 10, 2)) . "<br>";

// Function to calculate average of an array
function calculateAverage($numbers) {
    $sum = array_sum($numbers);
    $count = count($numbers);
    return ($count > 0) ? ($sum / $count) : 0;
}

echo calculateAverage(array(10, 20, 30, 40, 50)) . "<br>";

// Right-angled triangle pattern
$rows = 5;
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// Inverted right-angled triangle pattern
for ($i = $rows; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// Pyramid pattern
for ($i = 1; $i <= $rows; $i++) {
    for ($j = $i; $j < $rows; $j++) {
        echo "&nbsp;";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}

// Inverted pyramid pattern
for ($i = $rows - 1; $i >= 1; $i--) {
    for ($j = $rows; $j > $i; $j--) {
        echo "&nbsp;";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}

// Number pattern
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }
    echo "<br>";
}
?>

