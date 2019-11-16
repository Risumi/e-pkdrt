	@include('header')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
	    integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
	<script src="https://code.highcharts.com/highcharts.src.js"></script>
	<script src="{{ asset('kecamatan.js') }}"></script>
	@include('modal.modalFilterTahun')
	@foreach($kasusKelurahan as $data)
		@include('modal.modalKecamatan')
	@endforeach
	<?php	
		$dataPoints = array();
		$arrayKec =array();
		$arrayKecNilai =array();
		foreach ($kasusKecamatan as $data ) {				
			array_push($arrayKec,'"'.$data->fk_id_district.'"');			
			array_push($arrayKecNilai,$data->total);			
		}			
		$arrayLok =array();
		$arrayLokNilai =array();
		foreach ($kategoriLok as $data ) {				
			array_push($arrayLok,'"'.$data->kategori.'"');			
			array_push($arrayLokNilai,$data->total);				
		}
		$arrayLokKrbn =array();
		$arrayLokNilaiKrbn =array();
		foreach ($kategoriLokKrbn as $data ) {				
			array_push($arrayLokKrbn,'"'.$data->kategori.'"');			
			array_push($arrayLokNilaiKrbn,$data->total);				
		}
		$arrayJnsLynan =array();
		$arrayJnsLynanNilai =array();
		foreach ($jenisLayanan as $data ) {				
			array_push($arrayJnsLynan,'"'.$data->pelayanan.'"');			
			array_push($arrayJnsLynanNilai,$data->total);				
		}
		$arrayRentangUsia =array();
		$arrayRentangUsiaNilai =array();
		foreach ($rentangUsia as $data ) {				
			array_push($arrayRentangUsia,'"'.$data->range_umur.'"');			
			array_push($arrayRentangUsiaNilai,$data->total);				
		}
		$arrayPendidikan =array();
		$arrayPendidikanNilai=array();
		foreach ($pendidikan as $data ) {				
			array_push($arrayPendidikan,'"'.$data->pendidikan.'"');			
			array_push($arrayPendidikanNilai,$data->total);				
		}
		$arrayJnsKelamin =array();
		$arrayJnsKelaminNilai=array();
		foreach ($jnsKelamin as $data ) {				
			array_push($arrayJnsKelamin,'"'.$data->jenis_kelamin.'"');			
			array_push($arrayJnsKelaminNilai,$data->total);				
		}
		// dd($arrayJnsKelamin);
		$arrayHubPelaku =array();
		$arrayHubPelakuNilai=array();
		foreach ($hubPelaku as $data ) {				
			array_push($arrayHubPelaku,'"'.$data->hubungan_dengan_korban.'"');			
			array_push($arrayHubPelakuNilai,$data->total);				
		}
		// dd($hubPelaku);
		// dd($arrayRentangUsiaNilai);
	?>

	<body>
	    <style>
	        .kecamatan:hover {
	            stroke: #002868 !important;
	            stroke-width: 2px;
	            stroke-linejoin: round;
	            fill: #fffb8d !important;
	            cursor: pointer;
	        }

	        #info-box {
	            display: none;
	            position: absolute;
	            top: 0px;
	            left: 0px;
	            z-index: 1;
	            background-color: #ffffff;
	            border: 2px solid #002868;
	            border-radius: 5px;
	            padding: 5px;
	            font-family: arial;
	        }

	    </style>
	    <div id="info-box"></div>
		<br>
	    <div class="container">
			<div class="d-flex justify-content-center">
                <button type="submit" data-toggle="modal" data-target="#modalFilterTahun" class="btn btn-primary">Filter</button>
            </div>
	        <div class="row">
	            <div class="col" align="center">
	                @include('kotaMalang')
	            </div>
	        </div>
	        <div class="d-flex justify-content-center">
	            <div align="center" id="jmlKasusKec" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="pieUmurAnak" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="pieUmurPerempuan" style="height: 370px; width: 55%;"></div>
	        </div>
	        <div class="d-flex justify-content-center">
	            <div align="center" id="kssKategoriLok" style="height: 370px; width: 55%;"></div>
	        </div>
	        <div class="d-flex justify-content-center">
	            <div align="center" id="krbnKategoriLok" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="jnsLayanan" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="rentangUsia" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="pendidikan" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="jnsKelamin" style="height: 370px; width: 55%;"></div>
	        </div>
			<div class="d-flex justify-content-center">
	            <div align="center" id="hubPelaku" style="height: 370px; width: 55%;"></div>
	        </div>		
	    </div>

	</body>
	<script type="text/javascript">
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
	</script>
	<script type="text/javascript">
	    $(function () {
	        var chart = new Highcharts.Chart({
	            chart: {
	                renderTo: 'jmlKasusKec',
	                type: 'column',
	            },
	            title: {
	                text: 'Jumlah kasus per kecamatan'
				},
				tooltip:{
					headerFormat: '',
				},
	            xAxis: {
					enabled: false,
					visible: false				
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
	                column: {
	                    dataLabels: {
	                        enabled: true
	                    }
	                }
	            },

	            credits: {
	                enabled: false
	            },
	            series: [
					<?php
						foreach ($kasusKecamatan as $data ) {				
							echo('{name:').'"'.$data->fk_id_district.'",';
							echo('data:[').$data->total."]},";							
						}	
					?>
	                
	            ]
	        });
	    });	    	        	        	    
	</script>
	<script type="text/javascript">
		Highcharts.chart('pieUmurAnak', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Data kekerasan terhadap anak'
			},
			subtitle: {
				text: 'Berdasarkan usia korban'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',				
					dataLabels: {
						enabled: true,
						format: '<b>{point.name} tahun</b><br>{point.y} kasus'
					}
				}
			},
			series: [{
				name: 'Jumlah kasus',
				colorByPoint: true,
				data: [	<?php foreach ($rentangUsiaAnak as $data ) {				
							echo('{name:').'"'.$data->range_umur.'",';
							echo('y:').$data->total."},";							
					} ?>               
				]
			}]
		});				
	</script>
	<script type="text/javascript">
		Highcharts.chart('pieUmurPerempuan', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Data kekerasan terhadap perempuan'
			},
			subtitle: {
				text: 'Berdasarkan usia korban'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',				
					dataLabels: {
						enabled: true,
						format: '<b>{point.name} tahun</b><br>{point.y} kasus'
					}
				}
			},
			series: [{
				name: 'Jumlah kasus',
				colorByPoint: true,
				data: [	<?php foreach ($rentangUsiaPerempuan as $data ) {				
							echo('{name:').'"'.$data->range_umur.'",';
							echo('y:').$data->total."},";							
					} ?>               
				]
			}]
		});				
	</script>
	<script type="text/javascript">
	    $(function () {
			var chart = new Highcharts.Chart({
				chart: {
					renderTo: 'kssKategoriLok',
					type: 'column',
				},
				title: {
					text: 'Jumlah Kasus berdasarkan Tempat Kejadian'
				},
				xAxis: {
					categories: [<?= join($arrayLok, ','); ?> ],
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
					name: 'Jumlah Kasus',
					data: [ <?= join($arrayLokNilai, ',') ?> ],
				}]
			});		
		});		 	        	        	    
	</script>
	<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'krbnKategoriLok',
						type: 'column',
					},
					title: {
						text: 'Jumlah Korban berdasarkan Tempat Kejadian'
					},
					xAxis: {
						categories: [ <?= join($arrayLok, ','); ?> ],
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
						name: 'Jumlah Koeban',
						data: [ <?= join($arrayLokNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
	<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'jnsLayanan',
						type: 'column',
					},
					title: {
						text: 'Jenis layanan yang diberikan'
					},
					xAxis: {
						categories: [ <?= join($arrayJnsLynan, ','); ?> ],
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
						data: [ <?= join($arrayJnsLynanNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
	<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'rentangUsia',
						type: 'column',
					},
					title: {
						text: 'Korban berdasarkan usia'
					},
					xAxis: {
						categories: [ <?= join($arrayRentangUsia, ','); ?> ],
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
						name: 'Jumlah Korban',
						data: [ <?= join($arrayRentangUsiaNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
	<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'pendidikan',
						type: 'column',
					},
					title: {
						text: 'Korban berdasarkan usia'
					},
					xAxis: {
						categories: [ <?= join($arrayPendidikan, ','); ?> ],
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
						name: 'Jumlah Korban',
						data: [ <?= join($arrayPendidikanNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
		<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'jnsKelamin',
						type: 'column',
					},
					title: {
						text: 'Pelaku berdasarkan jenis kelamin'
					},
					xAxis: {
						categories: [ <?= join($arrayJnsKelamin, ','); ?> ],
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
						name: 'Jumlah Pelaku',
						data: [ <?= join($arrayJnsKelaminNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
		<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'hubPelaku',
						type: 'column',
					},
					title: {
						text: 'Pelaku berdasarkan hubungan'
					},
					xAxis: {
						categories: [ <?= join($arrayHubPelaku, ','); ?> ],
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
						name: 'Jumlah Pelaku',
						data: [ <?= join($arrayHubPelakuNilai, ',') ?> ],
					}]
				});
			});        	        	    
	</script>
</html>
