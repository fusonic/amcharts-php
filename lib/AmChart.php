<?php

/*
 * AmCharts-PHP 0.3
 * Copyright (C) 2009-2014 Fusonic GmbH
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
    protected $libraryPath;

    /**
     * Constructor can only be called from derived class because AmChart
     * is abstract.
     *
     * @param	string				$id
     */
    public function __construct($id = null)
    {
        if($id)
        {
            $this->id = $id;
        }
        else
        {
            $this->id = substr(md5(uniqid() . microtime()), 3, 5);
        }

        $this->config['width'] = "100%";
        $this->config['height'] = "300px";
        $this->setDefaultConfig();
    }

    /**
     * Add a title to the chart
     *
     * @param   string          $text
     * @param   string          $color
     * @param   int             $size
     * @param   string          $id         HTML-ID of the title
     * @param   int             $alpha
     * @return  void
     */
    public function addTitle($text, $color = "", $size = 14, $id = "chart-title", $alpha = 1)
    {
        $this->config["titles"][] = array(
            "text" => $text,
            "color" => $color,
            "size" => $size,
            "id" => $id,
            "alpha" => $alpha
        );
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
     * @param	array				$config
     * @param	bool				$merge
     */
    public function setConfigAll(array $config, $merge = false)
    {
        if($merge)
        {
            foreach($config AS $key => $value)
            {
                $this->config[$key] = $value;
            }
        }
        else
        {
            $this->config = $config;
        }
    }

    /**
     * Sets one config variable.
     *
     * @param	string				$key
     * @param	mixed				$value
     */
    public function setConfig($key, $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * Returns the config array.
     *
     * @return	array
     */
    public abstract function getConfig();

    /**
     * Returns the ready-to-use config JSON string
     * @return	string
     */
    public function getChartJSON()
    {
        $this->config["dataProvider"] = $this->getData();
        return json_encode($this->getConfig());
    }

    /**
     * Returns the ready-to-use data
     *
     * @return	array
     */
    public abstract function getData();

    /**
     * Set the graph's data
     *
     * @param   array           $data
     * @return  void
     */
    public abstract function setData($data);

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

}
