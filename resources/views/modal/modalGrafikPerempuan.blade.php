<div class="modal fade" id="modalGrafikPerempuan" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Persentase Detail Korban Perempuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">            
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="korbanUmurPerempuan" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="pendidikanPerempuan" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="pekerjaanPerempuan" style="height: 370px; width: 80%;"></div>
						</div>                    
					</div>
					<div class="col-sm">
						<div class="d-flex justify-content-center">
                    		<div align="center" id="tempatPerempuan" style="height: 370px; width: 80%;"></div>
                		</div>      
					</div>
				</div>                 
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
	Highcharts.chart('korbanUmurPerempuan', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Perempuan menurut Kelompok Umur'
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
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($rentangUsiaPerem as $data ) {				
						echo('{name:').'"'.$data->range_umur.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('pendidikanPerempuan', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Perempuan menurut Pendidikan'
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
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($pendidikanPerempuan as $data ) {				
						echo('{name:').'"'.$data->pendidikan.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('pekerjaanPerempuan', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Perempuan menurut Pekerjaan'
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
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($pekerjaanPerempuan as $data ) {				
						echo('{name:').'"'.$data->pekerjaan.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>
<script type="text/javascript">
	Highcharts.chart('tempatPerempuan', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Korban Perempuan menurut Tempat Kejadian'
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
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Jumlah kasus',
			colorByPoint: true,
			data: [	<?php foreach ($tempatPerempuan as $data ) {				
						echo('{name:').'"'.$data->kategori.'",';
						echo('y:').$data->total."},";							
				} ?>               
			]
		}]
	});				
</script>