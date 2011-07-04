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

/*
 * Base class for AmLineChart and AmBarChart.
 */
abstract class AmLineBarChart extends AmChart 
{

	protected $series = array();
	protected $graphs = array();

	protected $defaultGraphConfig = array();

	/**
	 * Adds a new serie (value on the X axis).
	 *
	 * @param	string				$_id
	 * @param	string				$_title
	 * @param	array				$_config
	 */
	public function addSerie($_id, $_title, array $_config = array()) 
	{
		$this->series[$_id] = array(
			"title" => $_title,
			"config" => $_config
		);
	}

	/**
	 * Adds a new graph (data line/bar).
	 *
	 * @param	string				$_id
	 * @param	string				$_title
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
		 * Series
		 */
		$series = $chart->addChild("series");
		foreach($this->series AS $key => $serie) 
		{
			$valueNode = $series->addChild("value", $serie['title']);
			$valueNode->addAttribute("xid", $key);
		}

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
			foreach($graph['data'] AS $key => $value) 
			{
				$valueNode = $graphNode->addChild("value", $value);
				$valueNode->addAttribute("xid", $key);
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