	@include('header')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
	    integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
	<script src="https://code.highcharts.com/highcharts.src.js"></script>
	<script src="{{ asset('kecamatan.js') }}"></script>
	<link rel="stylesheet" href="https://kekerasan.kemenpppa.go.id/assets/template/dist/css/AdminLTE.min.css">
	
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
	            fill: yellow !important;
	            cursor: pointer;
	        }
			.container{
				max-width:95%;
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

		<div class="row">
			<div class="col-lg-4 col-xs-12">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>{{$totKasus}}</h3>
						<p>Jumlah Kasus</p>
					</div>
				<div class="icon">
					<i class="fa fa-gg"></i>
				</div>
					<a href="" class="small-box-footer conbtn fancybox.ajax" data-toggle="modal" data-target="#modalGrafikKasus">Lebih lengkap <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-4 col-xs-12">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$totLaki}}</h3>
						<p>Korban Laki-laki</p>
					</div>
					<div class="icon">
						<i class="fa fa-mars"></i>
					</div>
					<a href="" class="small-box-footer conbtn fancybox.ajax" data-toggle="modal" data-target="#modalGrafikLaki">Lebih lengkap <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
				<div class="col-lg-4 col-xs-12">				
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>{{$totPerempuan}}</h3>
						<p>Korban Perempuan</p>
					</div>
				<div class="icon">
					<i class="fa fa-venus"></i>
				</div>
						<a href="" class="small-box-footer conbtn fancybox.ajax" data-toggle="modal" data-target="#modalGrafikPerempuan">Lebih lengkap <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="d-flex float-right">
                <button type="submit" data-toggle="modal" data-target="#modalFilterTahun" class="btn btn-primary">Filter</button>
            </div>
	        <div class="row">
	            <div class="col-sm" align="center">					
	                @include('kotaMalang')
	            </div>
			</div>
			<div class="row">
				<div class="col-sm">
					<div class="d-flex justify-content-center">
						<div align="center" id="jmlKasusKec" style="height: 400px; width: 100%;"></div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="kssKategoriLok" style="height: 400px; width: 100%;"></div>
	        		</div>					
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center">
						<div align="center" id="krbnKategoriLok" style="height: 400px; width: 100%;"></div>
					</div>
				</div>
			</div>				        
			<div class="row">
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="jnsKekerasan" style="height: 400px; width: 100%;"></div>
	        		</div>					
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="jnsLayanan" style="height: 400px; width: 100%;"></div>
	        		</div>
				</div>
			</div>				        
	        <div class="row">
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="rentangUsia" style="height: 400px; width: 100%;"></div>
	        		</div>
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="pendidikan" style="height: 400px; width: 100%;"></div>
	        		</div>
				</div>
			</div>			
			<div class="row">
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="jnsKelamin" style="height: 400px; width: 100%;"></div>
	        		</div>
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center">
	            		<div align="center" id="hubPelaku" style="height: 400px; width: 100%;"></div>
	        		</div>		
				</div>
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
					},
					showInLegend: true
				}
			},
			credits: {
	                enabled: false
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
				series: [<?php foreach ($kategoriLok as $data ) {				
							echo('{name:').'"'.$data->kategori.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
					series: [<?php foreach ($kategoriLokKrbn as $data ) {				
							echo('{name:').'"'.$data->kategori.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
				});
			});        	        	    
	</script>
	<script type="text/javascript">
	    $(function () {
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'jnsKekerasan',
						type: 'column',
					},
					title: {
						text: 'Jenis kekerasan yang dialami korban'
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
					series: [<?php foreach ($kekerasan as $data ) {				
							echo('{name:').'"'.$data->jenis_kekerasan.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
					series: [<?php foreach ($jenisLayanan as $data ) {				
							echo('{name:').'"'.$data->pelayanan.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
					series: [<?php foreach ($rentangUsia as $data ) {				
							echo('{name:').'"'.$data->range_umur.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
						text: 'Korban berdasarkan jenjang pendikan'
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
					series: [<?php foreach ($pendidikan as $data ) {				
							echo('{name:').'"'.$data->pendidikan.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
					series: [<?php foreach ($jnsKelamin as $data ) {				
							echo('{name:').'"'.$data->jenis_kelamin.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
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
					series: [<?php foreach ($hubPelaku as $data ) {				
							echo('{name:').'"'.$data->hubungan_dengan_korban.'",';
							echo('data:[').$data->total."]},";							
					} ?>]
				});
			});        	        	    
	</script>
	@include('modal.modalFilterTahun')	
	@foreach($kasusKelurahan as $data)
		@include('modal.modalKecamatan')
	@endforeach
	@include('modal.modalGrafikKasus')
	@include('modal.modalGrafikLaki')
	@include('modal.modalGrafikPerempuan')
	<br>	
</html>

