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

require_once(dirname(__FILE__) . "/AmChart.php");

/**
 * Class to create a pie chart from the amCharts library.
 */
class AmPieChart extends AmChart
{
    protected $defaultSliceConfig = array();
    protected $jsPath = "pie.js";

    /**
     * @see AmChart::getJSPath()
     */
    public function getJSPath()
    {
        return $this->jsPath;
    }

    /**
     * @see AmChart::setJSPath($path)
     */
    public function setJsPath($path)
    {
        $this->jsPath = $path;
    }

    /**
     * @see AmChart::getData()
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @see     AmChart::setData()
     * @param   arraz           $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    protected function setDefaultConfig()
    {
        $this->config['type'] = "pie";
        $this->config['titleField'] = "title";
        $this->config['valueField'] = "value";
    }

    /**
     * Returns the config array.
     *
     * @return    array
     */
    public function getConfig()
    {
        return $this->config;
    }
}