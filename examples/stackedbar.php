<?php

/*
 * Read README file first.
 *
 * This example shows how to create a simple stacked bar chart with a few configuration
 * directives.
 * The values are from http://www.globalissues.org/article/26/poverty-facts-and-stats
 */

// Require necessary files
require("../lib/AmBarChart.php");

// Alls paths are relative to your base path (normally your php file)
// Path to swfobject.js
AmChart::$swfObjectPath = "swfobject.js";
// Path to AmCharts files (SWF files)
AmChart::$libraryPath = "../../../amcharts";
// Path to jquery.js
AmChart::$jQueryPath = "jquery.js";

// Initialize the chart (the parameter is just a unique id used to handle multiple
// charts on one page.)
$chart = new AmBarChart("myStackedBarChart");

// The title we set will be shown above the chart, not in the flash object.
// So you can format it using CSS.
$chart->setTitle("Percent of people in the world at different poverty levels, 2005");

// Set chart settings to make it a stacked bar chart.
$chart->setConfig("column.type", "100% stacked");

// Add a label to describe the X values (inside the chart).
$chart->addLabel("The values on the X axis describe the Purchasing Power in USD Dollars a day.", 0, 20);

// Add all values for the X axis
$chart->addSerie("1_00", "$1.00");
$chart->addSerie("1_25", "$1.25");
$chart->addSerie("1_45", "$1.45");
$chart->addSerie("2_00", "$2.00");
$chart->addSerie("2_50", "$2.50");
$chart->addSerie("10_00", "$10.00");

// Define graphs data
$belowPovertyLine = array(
	"1_00" => 0.88,
	"1_25" => 1.40,
	"1_45" => 1.72,
	"2_00" => 2.60,
	"2_50" => 3.14,
	"10_00" => 5.15
);
$abovePovertyLine = array(
	"1_00" => 5.58,
	"1_25" => 5.06,
	"1_45" => 4.74,
	"2_00" => 3.86,
	"2_50" => 3.32,
	"10_00" => 1.31
);

// Add graphs
$chart->addGraph("below", "Below the poverty line", $belowPovertyLine);
$chart->addGraph("above", "Above the poverty line", $abovePovertyLine);

// Print the code
echo $chart->getCode();