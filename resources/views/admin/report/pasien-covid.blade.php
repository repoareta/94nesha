@extends('layouts.layout-admin')

@section('breadcrumb')
    {{ Breadcrumbs::render('pasien-covid') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endpush

@section('content')
<div class="container-fluid">
    <!--begin::Card-->
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="card-header" style="">
            <div class="card-title">
                <h3 class="card-label">Pasien Covid 
                <i class="mr-2"></i>
                <small class="">Data Pasien Covid</small></h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.report.formulir.pasien_covid.excel') }}" class="btn btn-light-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Export
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Nama Kontak</th>
                            <th scope="col">No Kontak</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tanggal Negatif</th>
                            <th scope="col">Goldar</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Desa</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ket Status</th>
                            <th scope="col">Kebutuhan</th>
                            <th scope="col">Meninggal Dunia</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Card-->
    <!--start::Modal Card-->

    <!-- Modal-->
    <div class="modal fade" id="penyintasModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menjadi Penyintas Covid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.report.formulir.pasien_covid.penyintas') }}" method="post" id="formPenyintas">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="font-size-h4">Tanggal Dinyatakan Positif</label>
                            <div class="input-group date mt-3">
                                <input type="text" id="tanggalPositif" class="form-control" name="tgl_positif" readonly="readonly" placeholder="Pilih Tanggal">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>                           
                        </div>
                        <div class="form-group">
                            <label class="font-size-h4">Kondisi</label>
                            <textarea name="kondisi" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-size-h4">Bisa Donor Plasma</label>
                            <div class="radio-list mt-3">
                                <label class="radio">
                                    <input type="radio" name="donor_plasma" value="T">
                                    <span></span>Ya
                                </label>
                                <label class="radio">
                                    <input type="radio" name="donor_plasma" value="F">
                                    <span></span>Tidak
                                </label>                                
                            </div>
                            @error('donor_plasma')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>                                
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" form="formPenyintas" class="btn btn-primary font-weight-bold">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal Card-->
    <!--start::Modal Card-->

    <!-- Modal-->
    <div class="modal fade" id="meninggalModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pasien Covid Meninggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.report.formulir.pasien_covid.meninggal') }}" method="post" id="formMeninggal">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="font-size-h4">Tanggal Dinyatakan Meninggal</label>
                            <div class="input-group date mt-3">
                                <input type="text" id="tanggalMeninggal" class="form-control" name="tgl_meninggal" readonly="readonly" placeholder="Pilih Tanggal">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>                           
                        </div>
                        <div class="form-group">
                            <label class="font-size-h4">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" form="formMeninggal" class="btn btn-primary font-weight-bold">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal Card-->

</div>
@endsection

@push('page-scripts')
    <!--Start::dataTable-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--End::dataTable-->
<script type="text/javascript">
    $(document).ready( function () {
        var t = $('#dataTable').DataTable({
            
			scrollX   : true,
            processing: true,
            ordering: true,
            serverSide: true,
            ajax: {
                url : '{!! url()->current() !!}'
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Harap Tunggu...'
            },
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
				{data: 'nama', name: 'nama'},
				{data: 'jurusan', name: 'jurusan'},
				{data: 'nama_kontak', name: 'nama_kontak'},
				{data: 'no_kontak', name: 'no_kontak'},
				{data: 'jenkel', name: 'jenkel'},
				{data: 'tgl_negatif', name: 'tgl_negatif'},
				{data: 'goldar', name: 'goldar'},
				{data: 'province', name: 'province'},
				{data: 'regency', name: 'regency'},
				{data: 'district', name: 'district'},
				{data: 'village', name: 'village'},
				{data: 'kondisi', name: 'kondisi'},
				{data: 'status', name: 'status'},
				{data: 'ket_status', name: 'ket_status'},
				{data: 'kebutuhan', name: 'kebutuhan'},
				{data: 'meninggal_dunia', name: 'meninggal_dunia'},
				{data: 'action', name: 'action'},
			]
		});

        $('#tanggalPositif').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "left bottom",
            locale: 'id',
            language: 'id',
            maxDate: '0',
            date: new Date(),
            endDate: new Date()
        });

        $('#tanggalMeninggal').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "left bottom",
            locale: 'id',
            language: 'id',
            maxDate: '0',
            date: new Date(),
            endDate: new Date()
        });

        $('#dataTable tbody').on( 'click', '#toPenyintas', function (e) {
			e.preventDefault();
			var id = $(this).attr('data-id');
            $('#penyintasModal').modal('show'); 
            $('input[name=id]').val(id);
		});

        $('#dataTable tbody').on( 'click', '#toMeninggal', function (e) {
			e.preventDefault();
			var id = $(this).attr('data-id');
            $('#meninggalModal').modal('show'); 
            $('input[name=id]').val(id);
		});
    } );
</script>
@endpush
