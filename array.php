<?php
$array = ["apple", "banana", "cherry"];
$array[] = "Potato";
array_push($array, "Mango", "Water Melon", "Strawberry");
foreach ($array as $index=> $item) {
    echo $index + 1 . "-" .$item . "<br>";
}

$x = range(1, 20, 2);
foreach ($x as $value) {
    echo $value . "<br>";
}

$colors = array("red", "green", "blue", "yellow");
array_push($colors, "purple", "orange");
$length = count($colors);


for ($i = 0; $i < $length; $i++) {
    echo $colors[$i] . "<br>";
}
?>