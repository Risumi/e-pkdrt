<div class="modal fade" id="modalGrafikKasus" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Persentase Korban dan Pelaku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="korbanJnsKelamin" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="pelakuJnsKelamin" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="rentangUsiaKorban" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="rentangUsiaPelaku" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="statusUsiaKorban" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="statusUsiaPelaku" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
	Highcharts.chart('korbanJnsKelamin', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban menurut Jenis Kelamin'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($korbanJnsKelamin as $data ) {				
						echo('{name:').'"'.$data->jenis_kelamin.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('pelakuJnsKelamin', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Pelaku menurut Jenis Kelamin'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($pelakuJnsKelamin as $data ) {				
						echo('{name:').'"'.$data->jenis_kelamin.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('rentangUsiaKorban', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban menurut Kelompok Umur'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($rentangUsia as $data ) {				
						echo('{name:').'"'.$data->range_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('rentangUsiaPelaku', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Pelaku menurut Kelompok Umur'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($rentangUsiaPelaku as $data ) {				
						echo('{name:').'"'.$data->range_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('statusUsiaKorban', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban menurut Status Usia'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($statusUsiaKorban as $data ) {				
						echo('{name:').'"'.$data->status_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('statusUsiaPelaku', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Pelaku menurut Status Usia'
		},		
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',				
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.2f}%'
				}
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($statusUsiaPelaku as $data ) {				
						echo('{name:').'"'.$data->status_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>