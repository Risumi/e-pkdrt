<div class="modal fade" id="modalFilter{{$data[0]}}" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
								<h3>{{$data[2][0]["total"]}}</h3>
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
									<h3>{{$data[2][1]["total"]}}</h3>
								<p>Korban Perempuan</p>
							</div>
						<div class="icon">
							<i class="fa fa-venus"></i>
						</div>							
						</div>
					</div>
				</div>      
                <div class="d-flex justify-content-center">
                    <div align="center" id="jmlKasusKel{{$data[0]}}" style="height: 370px; width: 80%;"></div>
                </div>                    
            </div>
            <!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
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
                        // dd($data[1][0]["fk_id_villages"]);
						foreach ($data[1] as $datas ) {	
                            // foreach ($datas as $kel ) {
                                echo('{name:').'"'.$datas["fk_id_villages"].'",';
                                echo('data:[').$datas["total"]."]},";							
                            // }										
						}	
					?>
	                
	            ]
	        });
	    });	    	        	        	    
	</script>