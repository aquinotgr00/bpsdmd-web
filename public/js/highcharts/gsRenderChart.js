
/* ======================================== 
    Document      : gsRenderChart.js
    Created on    : Aug 30, 2015
    Author        : Galih U. Syambudhi [syambudhi@gamatechno.com]
    Division      : Academic Software
    Description   : Render Chart From Response.
=========================================== */

/*
	NB :
	disabled title/label "highcharts.com" ===> edit file "highcharts.js" to credits:{enabled:false,text:"Highcharts.com",

	PARAM BASIC :
		chartType      : 'column'
		titleText      : 'xxx'
		subtitleText   : 'xxx'
		xAxisType      : 'category'
		yAxisText      : 'xxx'
		legendEnable   : true or false

*/


$(function () {

    // Create the chart
    $('#gsChartContainer').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Pendidikan Pembentukan'
        },
        subtitle: {
            text: 'Click the columns to view detail.'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        // main
        series: [{
            name: 'BPSDMP',
            colorByPoint: true,
            data: [
                {
                    name: 'DARAT',
                    y: 4,
                    drilldown: 'darat'
                }
            ]
        }],

            // drilldown 1
            drilldown: {
                series: [
                    {
                        name: 'PENDIDIKAN PEMBENTUKAN',
                        colorByPoint: true,
                        id: 'darat',
                        data: [
                            {
                                name: 'Pendidikan Pembentukan',
                                y: 5,
                                drilldown: 'pendidikan_pembentukan'
                            }
                        ]
                    }
                ]
            },
            
                // drilldown 2
                drilldown: {
                    series: [
                        {
                            name: 'STTD',
                            colorByPoint: true,
                            id: 'pendidikan_pembentukan',
                            data: [
                                {
                                    name: 'STTD',
                                    y: 5,
                                    drilldown: 'sttd'
                                }
                            ]
                        }
                    ]
                }
    });
});