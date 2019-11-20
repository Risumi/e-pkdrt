<div class="modal fade" id="modalGrafikLaki" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Persentase Detail Korban Laki-Laki</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">            
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="korbanUmurLaki" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="pendidikanLaki" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="pekerjaanLaki" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="tempatLaki" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
	Highcharts.chart('korbanUmurLaki', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Laki-Laki menurut Kelompok Umur'
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
			data: [	<?php foreach ($rentangUsiaLaki as $data ) {				
						echo('{name:').'"'.$data->range_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('pendidikanLaki', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Laki-Laki menurut Pendidikan'
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
			data: [	<?php foreach ($pendidikanLaki as $data ) {				
						echo('{name:').'"'.$data->pendidikan.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('pekerjaanLaki', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Laki-Laki menurut Pekerjaan'
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
			data: [	<?php foreach ($pekerjaanLaki as $data ) {				
						echo('{name:').'"'.$data->pekerjaan.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('tempatLaki', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Laki-Laki menurut Tempat Kejadian'
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
			data: [	<?php foreach ($tempatLaki as $data ) {				
						echo('{name:').'"'.$data->kategori.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>