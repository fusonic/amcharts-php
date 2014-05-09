<?php

/*
 * This example shows how to create a simple pie chart
 */

// Require necessary files
require("../lib/AmPieChart.php");

// Create a new pie chart
$chart = new AmPieChart("myPieChart");

// Set the path to the amcharts JS library
$chart->setLibraryPath("../amcharts");

$chart->addTitle("Percent of people in the world at different poverty levels, 2005");

$chart->setData(getData());

$chart->setConfig("valueField", "percentage");
$chart->setConfig("titleField", "text");

// Get the HTML/JS code
echo $chart->getCode();

function getData()
{
    return array(
        array(
            "percentage" => 0.88,
            "text" => "Below the poverty line"
        ),
        array(
            "percentage" => 5.58,
            "text" => "Above the poverty line"
        )
    );
}