<div class="modal fade" id="modalFilter{{$data[0]}}" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{$data[0]}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">      
				<div class="row">
					<div class="col-lg-4 col-xs-12">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>{{($data[3])}}</h3>
								<p>Jumlah Kasus</p>
							</div>
						<div class="icon">
							<i class="fa fa-gg"></i>
						</div>							
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="small-box bg-green">
							<div class="inner">
								<h3>{{isset($data[2][0]) ? $data[2][0]["total"]:0}}</h3>
								<p>Korban Laki-laki</p>
							</div>
							<div class="icon">
								<i class="fa fa-mars"></i>
							</div>							
						</div>
					</div>
						<div class="col-lg-4 col-xs-12">				
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3>{{isset($data[2][1]) ? $data[2][1]["total"]:0}}</h3>
								<p>Korban Perempuan</p>
							</div>
						<div class="icon">
							<i class="fa fa-venus"></i>
						</div>							
						</div>
					</div>
				</div>      
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="jmlKasusKel{{$data[0]}}" style="height: 370px; width: 100%;"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="kssKategoriLok{{$data[0]}}" style="height: 370px; width: 100%;"></div>
						</div>						
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="krbnKategoriLok{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="jnsKekerasan{{$data[0]}}" style="height: 370px; width: 100%;"></div>
						</div>
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="jnsLayanan{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>
					</div>
				</div>				        
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="rentangUsia{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="pendidikan{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>
					</div>
				</div>			
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="jnsKelamin{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
							<div align="center" id="hubPelaku{{$data[0]}}" style="height: 400px; width: 100%;"></div>
						</div>		
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'jmlKasusKel{{$data[0]}}',
				type: 'column',
			},
			title: {
				text: 'Jumlah kasus per kelurahan '
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
					foreach ($data[1] as $datas ) {							
							echo('{name:').'"'.$datas["fk_id_villages"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>
				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'kssKategoriLok{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[4] as $datas ) {							
							echo('{name:').'"'.$datas["kategori"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'krbnKategoriLok{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[5] as $datas ) {							
							echo('{name:').'"'.$datas->kategori.'",';
							echo('data:[').$datas->total."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'jnsKekerasan{{$data[0]}}',
				type: 'column',
			},
			title: {
				text: 'Jumlah kasus per kelurahan '
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
					foreach ($data[11] as $datas ) {							
							echo('{name:').'"'.$datas->jenis_kekerasan.'",';
							echo('data:[').$datas->total."]},";													
					}	
				?>
				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'jnsLayanan{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[6] as $datas ) {							
							echo('{name:').'"'.$datas["pelayanan"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'rentangUsia{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[7] as $datas ) {							
							echo('{name:').'"'.$datas["range_umur"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'pendidikan{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[8] as $datas ) {							
							echo('{name:').'"'.$datas["pendidikan"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'jnsKelamin{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[9] as $datas ) {							
							echo('{name:').'"'.$datas["jenis_kelamin"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'hubPelaku{{$data[0]}}',
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
			series: [
				<?php					
					foreach ($data[10] as $datas ) {							
							echo('{name:').'"'.$datas["hubungan_dengan_korban"].'",';
							echo('data:[').$datas["total"]."]},";													
					}	
				?>				
			]
		});
	});
</script>