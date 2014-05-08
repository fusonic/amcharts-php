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

    protected $data = array();
	protected $graphs = array();
    protected $jsPath = "xy.js";

    /**
     * @see AmChart::getJSPath()
     */
    public function getJSPath()
    {
        return $this->jsPath;
    }

    /**
     * Adds a new graph
     * @param	string				$_id
     * @param	string				$_title
     * @param	array				$_config
     */
    public function addGraph($_id, $_title, array $_config = array())
    {
        $this->graphs[] = array_merge(array(
            "valueField" => $_id,
            "title" => $_title
        ), $_config);
    }

    public function addData($data)
    {
        $this->data = $data;
    }

    /**
     * @see AmChart::getData()
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @see AmChart::setJSPath($path)
     */
    public function setJsPath($path)
    {
        $this->jsPath = $path;
    }


    protected function setDefaultConfig()
    {
        $this->config["type"] = "xy";
    }

    /**
     * Returns the config array.
     *
     * @return    array
     */
    public function getConfig()
    {
        $this->config['graphs'] = $this->graphs;
        return $this->config;
    }

}