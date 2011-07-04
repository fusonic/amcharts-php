<?php

/*
 * Read README file first.
 *
 * This example shows how to create a simple radar chart with a few configuration
 * directives.
 */

// Require necessary files
require("../lib/AmRadarChart.php");

// Alls paths are relative to your base path (normally your php file)
// Path to swfobject.js
AmChart::$swfObjectPath = "swfobject.js";
// Path to AmCharts files (SWF files)
AmChart::$libraryPath = "../../../amcharts";
// Path to jquery.js
AmChart::$jQueryPath = "jquery.js";

// Initialize the chart (the parameter is just a unique id used to handle multiple
// charts on one page.)
$chart = new AmRadarChart("myRadarChart");

$chart->addAxis('n', 'North');
$chart->addAxis('e', 'East');
$chart->addAxis('s', 'South');
$chart->addAxis('w', 'West');

// Set type to make a stacked chart
$chart->setConfig("type", "stacked");

// Values 1
$values = array(
	"n" => 10,
	"e" => 3,
	"s" => 5,
	"w" => 1
);
$chart->addGraph("1", "Values 1", $values);

// Values 2
$values = array(
	"n" => 3,
	"e" => 11,
	"s" => 2,
	"w" => 8
);
$chart->addGraph("2", "Values 2", $values, array("color" => "#FF00FF"));

// Print the code
echo $chart->getCode();