    $(".kecamatan").hover(function (e) {
        $('#info-box').css('display', 'block');
        $('#info-box').html($(this).data('info'));
    });

    $(".kecamatan").mouseleave(function (e) {
        $('#info-box').css('display', 'none');
    });

    $(document).mousemove(function (e) {
        $('#info-box').css('top', e.pageY - $('#info-box').height() - 30);
        $('#info-box').css('left', e.pageX - ($('#info-box').width()) / 2);
    }).mouseover();

    $(function () {
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'jmlKasusKec',
                type: 'column',
            },
            title: {
                text: 'Jumlah kasus per kecamatan'
            },
            xAxis: {
                categories: [ < ? = join($arrayKec, ','); ? > ],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: null,
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },

            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah kasus',
                data: [ < ? = join($arrayKecNilai, ',') ? > ],
            }]
        });
    });
    $(function () {
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'jmlKategoriLok',
                type: 'column',
            },
            title: {
                text: 'Jumlah Kasus berdasarkan Tempat Kejadian'
            },
            xAxis: {
                categories: [ <? = join($arrayLok, ','); ?> ],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: null,
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },

            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah kasus',
                data: [ < ? = join($arrayLokNilai, ',') ? > ],
            }]
        });
    });
