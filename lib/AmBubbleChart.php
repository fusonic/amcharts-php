<?php

/*
 * AmCharts-PHP 0.2.2
 * Copyright (C) 2009-2010 Fusonic GmbH
 *
 * This file is part of AmCharts-PHP.
 *
 * AmCharts-PHP is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * AmCharts-PHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library. If not, see <http://www.gnu.org/licenses/>.
 */

require_once(dirname(__FILE__) . "/AmChart.php");

/**
 * Class to create a bubble chart from the amCharts library.
 */
class AmBubbleChart extends AmChart 
{

	protected $graphs = array();
	protected $defaultGraphConfig = array();

	/**
	 * @see AmChart::getSwfPath()
	 */
	protected function getSwfPath() 
	{
		return self::$libraryPath . "/amxy.swf";
	}

	/**
	 * Adds a graph to the chart.
	 *
	 * @param	string				$_id
	 * @param	array				$_data
	 * @param	array				$_config
	 */
	public function addGraph($_id, $_title, array $_data, array $_config = array()) 
	{
		$this->graphs[$_id] = array(
			"title" => $_title,
			"data" => $_data,
			"config" => $_config
		);
	}

	/**
	 * Sets the default config for graphs.
	 *
	 * @param	array				$_config
	 */
	public function setDefaultGraphConfig(array $_config) 
	{
		$this->defaultGraphConfig = $_config;
	}

	/**
	 * @see AmChart::getDataXml()
	 */
	public function getDataXml($_asString = true) 
	{
		$chart = new SimpleXmlElement("<chart></chart>");

		/*
		 * Graphs
		 */

		$graphs = $chart->addChild("graphs");

		foreach($this->graphs AS $key => $graph) 
		{
			$graphNode = $graphs->addChild("graph");

			// Set attributes
			$graphNode->addAttribute("gid", $key);
			$graphNode->addAttribute("title", $graph['title']);

			$allAttributes = array_merge($this->defaultGraphConfig, $graph['config']);

			foreach($allAttributes AS $key => $value) 
			{
				$graphNode->addAttribute($key, ($value === true ? "true" : ($value === false ? "false" : $value)));
			}

			// Set data
			foreach($graph['data'] AS $point) 
			{
				$pointNode = $graphNode->addChild("point", (isset($point['title']) ? $point['title'] : null));

				foreach($point AS $key => $value) 
				{
					if($key == "title")
					{
						continue;
					}

					$pointNode->addAttribute($key, ($value === true ? "true" : ($value === false ? "false" : $value)));
				}
			}
		}


		/*
		 * Return
		 */
		if($_asString) 
		{
			$xmlString = $chart->asXML();
			// Remove XML Tag (not needed for config)
			$xmlString = trim(substr($xmlString, strpos($xmlString, "?>") + 2));
			return $xmlString;
		}
		else
		{
			return $chart;
		}
	}

}