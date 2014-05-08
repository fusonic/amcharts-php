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

$chart->setTitle("Percent of people in the world at different poverty levels, 2005");

// Add slices with addSlice
$chart->addSlice("below", "Below the poverty line", 0.88);
$chart->addSlice("above", "Above the poverty line", 5.58);

// Get the HTML/JS code
echo $chart->getCode();

?>

<table>
	<tr>
		<th></th>
		<th>Billions of people</th>
	</tr>
	<tr>
		<td>Less than 1$/day</td>
		<td>0.88</td>
	</tr>
	<tr>
		<td>More than 1$/day</td>
		<td>5.58</td>
	</tr>
</table>