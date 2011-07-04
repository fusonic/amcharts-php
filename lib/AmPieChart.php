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
 * Class to create a pie chart from the amCharts library.
 */
class AmPieChart extends AmChart 
{

	protected $slices = array();
	protected $defaultSliceConfig = array();

	/**
	 * @see AmChart::getSwfPath()
	 */
	protected function getSwfPath() 
	{
		return self::$libraryPath . "/ampie.swf";
	}

	/**
	 * Adds a new slice to the pie chart.
	 *
	 * @param	string				$_id
	 * @param	string				$_title
	 * @param	mixed				$_value
	 * @param	array				$_config
	 */
	public function addSlice($_id, $_title, $_value, array $_config = array()) 
	{
		$this->slices[$_id] = array(
			"title" => $_title,
			"value" => $_value,
			"config" => $_config
		);
	}

	/**
	 * Sets the default config for slices.
	 *
	 * @param	array				$_config
	 */
	public function setDefaultSliceConfig(array $_config) 
	{
		$this->defaultSliceConfig = $_config;
	}

	/**
	 * @see AmChart::getDataXml()
	 */
	public function getDataXml($_asString = true) 
	{
		$chart = new SimpleXmlElement("<pie></pie>");

		/*
		 * Slices
		 */
		foreach($this->slices AS $id => $slice) 
		{
			$sliceNode = $chart->addChild("slice", $slice['value']);
			$sliceNode->addAttribute("title", $slice['title']);

			// Config
			$allAttributes = array_merge($this->defaultSliceConfig, $slice['config']);

			foreach($allAttributes AS $key => $value) 
			{
				$sliceNode->addAttribute($key, $value);
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