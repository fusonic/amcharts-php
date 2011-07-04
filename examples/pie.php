<?php

/*
 * Read README file first.
 *
 * This example shows how to create a simple pie chart with a few configuration
 * directives and a connected HTML table as legend.
 * The values are from http://www.globalissues.org/article/26/poverty-facts-and-stats
 */

// Require necessary files
require("../lib/AmPieChart.php");

// Alls paths are relative to your base path (normally your php file)
// Path to swfobject.js
AmChart::$swfObjectPath = "swfobject.js";
// Path to AmCharts files (SWF files)
AmChart::$libraryPath = "../../../amcharts";
// Path to jquery.js and AmCharts.js (only needed for pie legend)
AmChart::$jsPath = "../lib/AmCharts.js";
AmChart::$jQueryPath = "jquery.js";
AmChart::$loadJQuery = true;

// Tell AmChart to load jQuery if you don't already use it on your site.

// Initialize the chart (the parameter is just a unique id used to handle multiple
// charts on one page.)
$chart = new AmPieChart("myPieChart");

// The title we set will be shown above the chart, not in the flash object.
// So you can format it using CSS.
$chart->setTitle("Percent of people in the world at different poverty levels, 2005");

// Add slices
$chart->addSlice("below", "Below the poverty line", 0.88);
$chart->addSlice("above", "Above the poverty line", 5.58);

// Print the code
echo $chart->getCode();

?>

<!--
We can use a connected HTML table with pie charts. If you assign the correct id in format
chart_{chartId}_legend, AmCharts-PHP will automatically connect the table with the chart.
-->

<style>
#chart_myPieChart_legend {
	border-collapse: collapse;
}
#chart_myPieChart_legend td, #chart_myPieChart_legend th {
	border: solid 1px grey;
}
#chart_myPieChart_legend tr.amChartsLegendHover {
	background-color: blue;
}
#chart_myPieChart_legend tr.amChartsLegendSelected {
	color: red;
}
</style>

<table id="chart_myPieChart_legend">
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