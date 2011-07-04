<?php

/*
 * Read README file first.
 *
 * This example shows how to create a simple bubble chart with a few configuration
 * directives.
 */

// Require necessary files
require("../lib/AmBubbleChart.php");

// Alls paths are relative to your base path (normally your php file)
// Path to swfobject.js
AmChart::$swfObjectPath = "swfobject.js";
// Path to AmCharts files (SWF files)
AmChart::$libraryPath = "../../../amcharts";
// Path to jquery.js
AmChart::$jQueryPath = "jquery.js";

// Initialize the chart (the parameter is just a unique id used to handle multiple
// charts on one page.)
$chart = new AmBubbleChart("myBubbleChart");

// Draw a triangle
$triangle = array(
	array(
		"x" => 2,
		"y" => 2,
		"value" => 1,
		"bullet_color" => "#FF0000"
	),
	array(
		"x" => 5,
		"y" => 5,
		"value" => 2,
		"bullet_color" => "#00FF00"
	),
	array(
		"x" => 8,
		"y" => 2,
		"value" => 3,
		"bullet_color" => "#0000FF"
	)
);
$chart->addGraph("triangle", "My open triangle", $triangle, array("bullet" => "bubble"));

// Draw a rectangle
$rectangle = array(
	array(
		"x" => 4,
		"y" => 2
	),
	array(
		"x" => 4,
		"y" => 3
	),
	array(
		"x" => 6,
		"y" => 3
	),
	array(
		"x" => 6,
		"y" => 2
	)
);
$chart->addGraph("rectangle", "My open rectangle", $rectangle, array("color" => "#000000"));

// Print the code
echo $chart->getCode();