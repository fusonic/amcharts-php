<?php

/*
 * AmCharts-PHP 0.3.1
 * Copyright (C) 2009-2013 Fusonic GmbH
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
    private $id;
    protected $config = array();
    protected $labels = array();
    protected $alternativeText = "Chart loading ...";
    protected $errorText = "Error!";
    protected $libraryPath = "amcharts/";

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

        $this->config['width'] = "100%";
        $this->config['height'] = "300px";
        $this->setDefaultConfig();
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
        $this->config['title'] = $_title;
    }

    /**
     * Returns the HTML Code to insert on the page.
     *
     * @return	string
     */
    public function getCode()
    {
        $code = '<div class="amChart" id="chart_' . $this->id . '" style="width: ' . $this->config["width"] . '; height: ' . $this->config["height"] . '"></div>' . "\n";
        unset($this->config["width"]);
        unset($this->config["height"]);

        $code .= '<script src="' . $this->libraryPath . '/amcharts.js"></script>';
        $code .= '<script src="' . $this->libraryPath . '/' . $this->getJSPath() . '"></script>';

        $code .= ''
            . '<script>' . "\n"
            . 'var chart = AmCharts.makeChart("chart_' . $this->id . '",' . $this->getChartJSON() . ');' . "\n"
            . '</script>' . "\n";

        return $code;
    }

    /**
     * Sets the config array. It should look like this:
     * array(
     *   "width" => "300px",
     *   "height" => "100px",
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
    public abstract function getConfig();

    /**
     * Returns the ready-to-use config JSON string
     * @return	mixed
     */
    public function getChartJSON()
    {
        $this->config["dataProvider"] = $this->getData();
        return json_encode($this->getConfig());
    }

    /**
     * Returns the ready-to-use data as JSON string
     * @return	string
     */
    public abstract function getData();

    /**
     * Returns the ready-to-use data as JSON string
     * @return	string
     */
    public function getDataJSON()
    {
        return json_encode($this->getData());
    }

    /**
     * Returns the path to the chart-specific js file.
     *
     * @return	string
     */
    protected abstract function getJSPath();

    /**
     * Sets the Path of the JS file the chart uses
     *
     * @param       string          $path
     * @return      void
     */
    protected abstract function setJSPath($path);

    /**
     * @param   string          $libraryPath
     */
    public function setLibraryPath($libraryPath)
    {
        $this->libraryPath = $libraryPath;
    }

    /**
     * @return  string
     */
    public function getLibraryPath()
    {
        return $this->libraryPath;
    }

    protected abstract function setDefaultConfig();

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