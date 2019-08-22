
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
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 50
            }
        },
        title: {
            text: 'PENDIDIKAN DAN PELATIHAN PERHUBUNGAN'
        },
        subtitle: {
            text: 'Click the columns to view detail.'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            },
            column: {
                depth: 100
            }
        },

        //  RENDER DATA
        //  DATA MAIN
        series: [{
            name: 'BPSDMP',
            colorByPoint: true,
            data: [
                {
                    name: 'DARAT',
                    y: 4,
                    drilldown: 'darat'
                },
                {
                    name: 'LAUT',
                    y: 4,
                    drilldown: ''
                },
                {
                    name: 'UDARA',
                    y: 4,
                    drilldown: ''
                },
                {
                    name: 'APARATUR',
                    y: 4,
                    drilldown: ''
                }
            ]
        }],

            //  DATA DRILLDOWN 1
            drilldown: {
                series: [{
                    id: 'darat',
                    name: 'JENIS PENDIDIKAN & PELATIHAN',
                    data: [
                        {
                            name: 'Pendidikan Pembentukan', 
                            y: 3,
                            drilldown: 'pendidikan_pembentukan'
                        },
                        ['Pendidikan Perjenjangan', 4],
                        ['Pendidikan Teknis', 1],
                        ['Pendidikan Lainnya', 2]
                    ]
                },

                    //  DATA DRILLDOWN 2
                    {
                        id:'pendidikan_pembentukan',
                        name: 'SATKER PENDIDIKAN PEMEBENTUKAN',
                        data: [
                            {
                                name: 'Satker STTD',
                                y: 3,
                                drilldown: 'sttd'
                            },
                            ['Satker BP3IP', 2],
                            ['Satker POLTRAN Tegal', 3]
                        ] 
                    },

                        //  DATA DRILLDOWN 3
                        {
                            id:'sttd',
                            name: 'PROGRAM STUDI',
                            data: [
                                {
                                    name: 'Diploma IV Transportasi Darat',
                                    y: 3,
                                    drilldown: 'diploma_iv_transportasi_darat'
                                },
                                ['Diploma III Lalu Lintas Angkutan Jalan (LLAJ)', 20],
                                ['Diploma III Perkeretaapian', 20]
                            ]
                        },

                            //  DATA DRILLDOWN 4
                            {
                                id:'diploma_iv_transportasi_darat',
                                name: 'PROGRAM STUDI',
                                data: [
                                    ['Peserta Target', 252],
                                    ['Peserta Realisasi Jumlah', 229],
                                    ['Lulusan Target', 54],
                                    ['Lulusan Realisasi Jumlah', 60],
                                    ['Prosentase Peserta', 60],
                                    ['Prosentase Lulusan', 54]
                                ]
                            },

                ]
            }
    })
});
    
