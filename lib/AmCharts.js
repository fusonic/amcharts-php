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

/*
 * Initialize
 */

function amChartInited(_id) 
{
	// Assign all tr handlers
	
	$("#chart_" + _id + "_legend tr").not(":has(th)").bind("click", function(e) {
		var index = $("#chart_" + _id + "_legend tr").not(":has(th)").index(this);
		$("#chart_" + _id + "_flash").get(0).clickSlice(index);
		$("#chart_" + _id + "_flash").get(0).rollOverSlice(index);
	});
	
	$("#chart_" + _id + "_legend tr").not(":has(th)").bind("mouseover", function(e) {
		var index = $("#chart_" + _id + "_legend tr").not(":has(th)").index(this);
		$("#chart_" + _id + "_flash").get(0).rollOverSlice(index);
	});
	
	$("#chart_" + _id + "_legend tr").not(":has(th)").bind("mouseout", function(e) {
		$("#chart_" + _id + "_flash").get(0).rollOutSlice();
	});
}


/*
 * Pie Charts
 */

function amSliceClick(_id, _index, _title, _value, _percents, _color, _description) 
{
	$("#chart_" + _id + "_legend tr").not(":has(th)").eq(_index).toggleClass("amChartsLegendSelected");
}

function amSliceOver(_id, _index, _title, _value, _precents, _color, _description) 
{
	$("#chart_" + _id + "_legend tr").not(":has(th)").eq(_index).addClass("amChartsLegendHover");
}

function amSliceOut(_id) 
{
	$("#chart_" + _id + "_legend tr").removeClass("amChartsLegendHover");
}