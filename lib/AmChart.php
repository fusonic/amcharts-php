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

/**
 * Base class for amChart PHP-Library
 */
abstract class AmChart 
{

	public static $swfObjectPath = "swfobject.js";
	public static $jQueryPath = "jquery.js";
	public static $jsPath = "AmCharts.js";
	public static $libraryPath = "amCharts/";

	public static $loadJQuery = false;
	private static $jsIncluded = false;

	private $id;
	protected $config = array();
	protected $labels = array();
	protected $title;
	protected $alternativeText = "Chart loading ...";
	protected $errorText = "Flash player error!";

	/**
	 * Constructor can only be called from derived class because AmChart
	 * is abstract.
	 *
	 * @param	string				$_id
	 */
	public function __construct($_id = null) 
	{
		if($_id)
		{
			$this->id = $_id;
		}
		else
		{
			$this->id = substr(md5(uniqid() . microtime()), 3, 5);
		}
	}

	public function addLabel($_text, $_x, $_y, array $_config = array()) 
	{
		$this->labels[] = array(
			"text" => $_text,
			"x" => $_x,
			"y" => $_y,
			"config" => $_config
		);
	}

	public function setTitle($_title) 
	{
		$this->title = $_title;
	}

	/**
	 * Returns the HTML Code to insert on the page.
	 *
	 * @return	string
	 */
	public function getCode() 
	{
		/*
		 * Create HTML/JS Code
		 */

		$code = '';

		// Background Color
		if(isset($this->config['background.color']) && is_array($this->config['background.color']))
		{
			$bgColor = $this->config['background.color'][0];
		}
		elseif(isset($this->config['background.color']))
		{
			$bgColor = $this->config['background.color'];
		}
		elseif(isset($this->config['background.alpha']))
		{
			$bgColor = "transparent";
		}
		else
		{
			$bgColor = "#FFFFFF";
		}

		// Width
		if(isset($this->config['width']))
		{
			$width = $this->config['width'];
		}
		else
		{
			$width = 400;
		}

		// Height
		if(isset($this->config['height']))
		{
			$height = $this->config['height'];
		}
		else
		{
			$height = 300;
		}

		// SWF Object
		if(!self::$jsIncluded) 
		{
			$code .= '<script type="text/javascript" src="' . self::$swfObjectPath . '"></script>' . "\n"
				. '<script type="text/javascript" src="' . self::$jsPath . '"></script>' . "\n";
			if(self::$loadJQuery)
			{
				$code .= '<script type="text/javascript" src="' . self::$jQueryPath . '"></script>' . "\n";
			}
			self::$jsIncluded = true;
		}

		$code .= '<div class="amChart" id="chart_' . $this->id . '_div">' . "\n";

		if($this->title)
		{
			$code .= '<div class="amChartTitle" id="chart_' . $this->id . '_div_title">' . $this->title . '</div>' . "\n";
		}

		$code .= ''
			. '<div class="amChartInner" id="chart_' . $this->id . '_div_inner"><div id="chart_' . $this->id . '_flash">' . $this->alternativeText . '</div></div>' . "\n"
			. '</div>' . "\n"
			. '<script type="text/javascript">' . "\n"
			. '// <![CDATA[' . "\n"
			. 'var flashvars = {};' . "\n"
			. 'flashvars.chart_id = "' . $this->id . '";' . "\n"
			. 'flashvars.chart_settings = escape("' . str_replace("\"", "'", $this->getConfigXml()) . '");' . "\n"
			. 'flashvars.chart_data = escape("' . str_replace("\"", "'", $this->getDataXml()) . '");' . "\n"
			. 'flashvars.path = "' . self::$libraryPath . '";' . "\n"
			. 'var params = {};' . "\n"
			. ($bgColor == "transparent" ? 'params.wmode="transparent";' . "\n" : "")
			. 'swfobject.embedSWF("' . $this->getSwfPath() . '", "chart_' . $this->id . '_flash", "' . $width . '", "' . $height . '", "8", "", flashvars, params, {}, function(e) {' . "\n"
				. 'if(!e.success) {' . "\n"
					. 'document.getElementById("chart_' . $this->id . '_flash").innerHTML = "' . $this->errorText . '";' . "\n"
				. '}' . "\n"
			. '});' . "\n"
			. '// ]]>' . "\n"
			. '</script>' . "\n";

		return $code;
	}

	/**
	 * Sets the config array. It should look like this:
	 * array(
	 *   "width" => 200,
	 *   "height" => 100,
	 *   "legend.enabled" => false
	 * )
	 *
	 * @param	array				$_config
	 * @param	bool				$_merge
	 */
	public function setConfigAll(array $_config, $_merge = false) 
	{
		if($_merge) 
		{
			foreach($_config AS $key => $value)
			{
				$this->config[$key] = $value;
			}
		}
		else
		{
			$this->config = $_config;
		}
	}

	/**
	 * Sets one config variable.
	 *
	 * @param	string				$_key
	 * @param	mixed				$_value
	 */
	public function setConfig($_key, $_value) 
	{
		$this->config[$_key] = $_value;
	}

	/**
	 * Returns the config array.
	 *
	 * @return	array
	 */
	public function getConfig() 
	{
		return $this->config;
	}

	/**
	 * Returns the ready-to-use config as XML string or SimpleXml element.
	 *
	 * @param	bool				$_asString
	 * @return	mixed
	 */
	public function getConfigXml($_asString = true) 
	{
		$settings = self::array2xml($this->config, "settings");

		/*
		 * Add Labels
		 */
		if(count($this->labels) > 0) 
		{
			$labels = $settings->addChild("labels");

			foreach($this->labels AS $label) 
			{
				$labelNode = $labels->addChild("label");
				$labelNode->addChild("text", $label['text']);
				$labelNode->addChild("x", $label['x']);
				$labelNode->addChild("y", $label['y']);

				foreach($label['config'] AS $key => $value) 
				{
					$labelNode->addChild($key, $value);
				}
			}
		}

		/*
		 * Return
		 */
		if($_asString) 
		{
			$xmlString = $settings->asXML();
			// Remove XML Tag (not needed for config)
			$xmlString = trim(substr($xmlString, strpos($xmlString, "?>") + 2));
			return $xmlString;
		}
		else
		{
			return $settings;
		}
	}

	/**
	 * Returns the ready-to-use data as XML string or SimpleXml element.
	 *
	 * @param	bool				$_asString
	 * @return	mixed
	 */
	public abstract function getDataXml($_asString = true);

	/**
	 * Returns the path to the chart-specific swf file.
	 *
	 * @return	string
	 */
	protected abstract function getSwfPath();

	/**
	 * Creates a SimpleXml element from the settings array.
	 *
	 * @param	array				$_data
	 * @param	string				$_rootNode
	 * @return	SimpleXmlElement
	 */
	public static function array2xml(array $_data, $_rootNode) 
	{
		$rootNode = new SimpleXmlElement("<" . $_rootNode . "></" . $_rootNode . ">");

		foreach($_data AS $key => $value) 
		{
			$keyPath = (array)explode(".", $key);
			$currentNode = $rootNode;

			for($i = 0; $i < count($keyPath) - 1; $i++) 
			{
				$nextNode = null;

				foreach($currentNode->children() AS $child) 
				{
					if($child->getName() == $keyPath[$i]) 
					{
						$nextNode = $child;
						break;
					}
				}

				if($nextNode === null)
				{
					$nextNode = $currentNode->addChild($keyPath[$i]);
				}

				$currentNode = $nextNode;
			}

			// Convert boolean values
			if($value === true || $value === false)
			{
				$value = (int)$value;
			}

			$currentNode->addChild($keyPath[count($keyPath) - 1], $value);
		}

		return $rootNode;
	}
	
	/**
	 * Set alternative text (shown if flash is not installed or chart could not
	 * be loaded).
	 * 
	 * @param	string	$text	alternative text
	 */
	public function setAlternativeText($text)
	{
		$this->alternativeText = $text;
	}
	
	/**
	 * Set error text (shown if an error occurs while initializing the chart).
	 * 
	 * @param	string	$text	error text
	 */
	public function setErrorText($text)
	{
		$this->errorText = $text;
	}

}