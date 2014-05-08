<?php

/*
 * This example shows how to create a simple bar chart with a few configuration
 * directives.
 */

// Require necessary files
require("../lib/AmSerialChart.php");

$chart = new AmSerialChart("myBarChart");

// Set the path to the amcharts JS library
$chart->setLibraryPath("../amcharts");

// Set the X axes to represent the "country" field (optional)
$chart->setConfig("categoryField", "country");
// Add uber nice animation (optional)
$chart->setConfig("startDuration", 1);

// Add the data for the chart to use
$chart->addData(getData());

// Add graphs
$graphConfigBolivia = array(
    "valueField" => "gdp",
    "balloonText" => "[[country]]: [[gdp]] $", // Optional,
    "type" => "column"
);

$chart->addGraph("GDP", "GDP per capita", $graphConfigBolivia);

// Get the HTML/JS code
echo $chart->getCode();

/**
 * Return sample data
 * @return array
 */
function getData()
{
    return array(
        array(
            "country" => "Bolivia",
            "gdp" => 2575,
        ),
        array(
            "country" => "Argentina",
            "gdp" => 11557,
        ),
        array(
            "country" => "Peru",
            "gdp" => 6573,
        ),
        array(
            "country" => "Chile",
            "gdp" => 15363,
        ),
        array(
            "country" => "Ecuador",
            "gdp" => 5456,
        ),
    );
}