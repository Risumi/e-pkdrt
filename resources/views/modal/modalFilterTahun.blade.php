<div class="modal fade" id="modalFilterTahun" tabindex="-1" role="dialog"
    aria-labelledby="modalRujukanTitle" aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Basis & Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <form action='' method="post">
                    @csrf                                   
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-3 col-form-label">Basis data</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="inputInstansi" name="FilterJenis">
                                <option value="Tanggal Pelaporan" {{("Tanggal Pelaporan" == $filterJenis) ? 'selected' : '' }}>Tanggal Pelaporan</option>
                                <option value="Tanggal Kejadian" {{("Tanggal Kejadian" == $filterJenis) ? 'selected' : '' }}>Tanggal Kejadian</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputTahun" name="FilterTahun" value={{$filterTahun}}>
                        </div>  
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-7">
                            <button type="submit" class="btn btn-primary">Set basis & periode</button>
                        </div>
                    </div>
                </form>
                    
            </div>
            <!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
        </div>
    </div>
</div>
