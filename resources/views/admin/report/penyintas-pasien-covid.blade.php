@extends('layouts.layout-admin')

@section('breadcrumb')
    {{ Breadcrumbs::render('penyintas-pasien-covid') }}
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
                <h3 class="card-label">Penyintas & Pasien Covid 
                <i class="mr-2"></i>
                <small class="">Data Penyintas & Pasien Covid</small></h3>
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
                            <th scope="col">Goldar</th>
                            <th scope="col">Tanggal Positif</th>
                            <th scope="col">Tanggal Negatif</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Desa</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan Status</th>
                            <th scope="col">Meninggal Dunia</th>
                            <th scope="col">Kebutuhan</th>
                            <th scope="col">Donor Plasma</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Card-->
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
				{data: 'goldar', name: 'goldar'},
				{data: 'tgl_positif', name: 'tgl_positif'},
				{data: 'tgl_negatif', name: 'tgl_negatif'},
				{data: 'province', name: 'province'},
				{data: 'regency', name: 'regency'},
				{data: 'district', name: 'district'},
				{data: 'village', name: 'village'},
				{data: 'kondisi', name: 'kondisi'},
				{data: 'status', name: 'status'},
				{data: 'ket_status', name: 'ket_status'},
				{data: 'meninggal_dunia', name: 'meninggal_dunia'},
				{data: 'kebutuhan', name: 'kebutuhan'},
				{data: 'donor_plasma', name: 'donor_plasma'},
			]
		});
    } );
</script>
@endpush
