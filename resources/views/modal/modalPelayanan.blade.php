<!-- Modal -->
<div class="modal fade" id="modalPelayanan{{$data->id_korban}}" tabindex="-1" role="dialog"
    aria-labelledby="modalPelayananTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pelayanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-default">
                    @if(session('notification'))
                    <div class="alert alert-success alert-dismisable">
                        <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                        <strong>{{ session('notification') }}</strong>
                    </div>
                    @endif
                    <div class="card-header">Data Pelayanan</div>
                    <div class="card-body">
                    <form action='{{ url("kasus/edit/$idKasus/korban/$data->id_korban/pelayanan/new") }}' method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputInstansi" name="instansi">
                                <option value="Bapas">Bapas</option>
                                <option value="Dinas Kesehatan">Dinas Kesehatan</option>
                                <option value="UPPA Polresta">UPPA Polresta</option>
                                <option value="RSUD">RSUD</option>
                                <option value="LPA">LPA</option>
                                <option value="WCC Dian Mutiara">WCC Dian Mutiara</option>
                                <option value="DSP3AP2KB">DSP3AP2KB</option>
                                <option value="RSSA">RSSA</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPelayanan" class="col-sm-2 col-form-label">Pelayanan yang Diberikan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputPelayanan" name="pelayanan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDetail" class="col-sm-2 col-form-label">Detail Pelayanan</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDetail" name="detail_pelayanan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Pelayanan</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" name="deskripsi_pelayanan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
        </div>
    </div>
</div>
