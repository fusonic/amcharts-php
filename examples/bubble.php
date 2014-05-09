<?php

/*
 * This example shows how to create a simple bubble chart.
 */

// Require necessary files
require("../lib/AmBubbleChart.php");

$chart = new AmBubbleChart("myBubbleChart");

// Set the path to the amcharts JS library
$chart->setLibraryPath("../amcharts");

// Add a graph
$chart->addGraph("value", "x", "y", array(
    "bullet" => "circle",
    "lineAlpha" => 0.3
));

// Add data
$chart->setData(getData());

// Get the HTML/JS code
echo $chart->getCode();

function getData()
{
    return array(
        array(
            "x" => 1,
            "y" => 6,
            "value" => 9
        ),
        array(
            "x" => 7,
            "y" => 15,
            "value" => 8
        ),
        array(
            "x" => 2,
            "y" => 15,
            "value" => 10
        ),
    );
}