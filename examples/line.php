<?php

/*
 * This example shows how to create a simple line chart with a few configuration directives.
 * The values are from http://www.globalissues.org/article/26/poverty-facts-and-stats
 */

// Require necessary files
require("../lib/AmSerialChart.php");

// Create a new serial chart
$chart = new AmSerialChart("myLineChart");

// Set the path to the amcharts JS library
$chart->setLibraryPath("../amcharts");

// Set the X axes to represent the "year" field (optional)
$chart->setConfig("categoryField", "year");
// Use a chart cursor (optional)
$chart->setConfig("chartCursor", array("cursorPointer" => "mouse"));

// Add the data for the chart to use
$chart->setData(getData());

// Add 2 graphs
$graphConfigBolivia = array(
    "balloonText" => "Bolivia: [[value]] $", // Optional
);

$chart->addGraph("bolivia", $graphConfigBolivia);

$graphConfigArgentina = array(
    "balloonText" => "Argentina: [[value]] $" // Optional
);

$chart->addGraph("argentina", $graphConfigArgentina);

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
            "bolivia" => 989,
            "argentina" => 7701,
            "year" => 2000
        ),
        array(
            "bolivia" => 939,
            "argentina" => 7209,
            "year" => 2001
        ),
        array(
            "bolivia" => 894,
            "argentina" => 2712,
            "year" => 2002
        ),
        array(
            "bolivia" => 955,
            "argentina" => 3413,
            "year" => 2003
        ),
        array(
            "bolivia" => 1021,
            "argentina" => 3997,
            "year" => 2004
        ),
        array(
            "bolivia" => 1203,
            "argentina" => 4740,
            "year" => 2005
        ),
        array(
            "bolivia" => 1356,
            "argentina" => 5490,
            "year" => 2006
        ),
        array(
            "bolivia" => 1696,
            "argentina" => 6630,
            "year" => 2007
        ),
        array(
            "bolivia" => 1735,
            "argentina" => 8231,
            "year" => 2008
        ),
        array(
            "bolivia" => 1935,
            "argentina" => 7674,
            "year" => 2009
        ),
        array(
            "bolivia" => 1925,
            "argentina" => 0133,
            "year" => 2010
        ),
    );
}