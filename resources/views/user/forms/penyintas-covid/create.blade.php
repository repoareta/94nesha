@extends('layouts.layout-user')

@push('page-styles')
    
@endpush

@section('content')
<div class="container">
    <!--begin::Row-->
    <div class="row justify-content-center">
        <!--begin::Col-->
        {{-- Validation error --}}
        @if (count($errors) > 0)
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-custom alert-light-danger fade show mb-3" role="alert">
                        <div class="alert-text">{{ $error }}</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="col-lg-6 col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b border-top-success" style="border-top-width: 5px; border-style: solid;">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::User-->
                    <div class="d-flex align-items-center mb-7">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4">
                            <div class="symbol symbol-circle symbol-lg-90">
                                <img src="{{ asset('images/covid19/svg/007-clean.svg') }}" alt="image">
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h1 mb-0">Data Penyintas Covid</a>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->
                    <!--begin::Label-->
                    <span class="text-danger font-weight-bold">* Wajib</span>
                    <!--end::Label-->
                    <!--begin::Buttons-->
                    <div class="mt-9">
                        <a href="{{ route('home') }}" class="btn btn-light-warning font-weight-bolder btn-sm font-size-lg py-3 px-6 text-uppercase">
                            <i class="fas fa-arrow-left fa-md"></i>
                            Back
                        </a>
                    </div>
                    <!--end::Buttons-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
            <!--begin::Form-->
            <form action="{{ route('penyintas_covid.store') }}" method="post" id="formPenyintas">
                @csrf
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Nama Lengkap <span class="text-danger font-size-sm">*</span></label>
                            <input type="text" class="form-control mt-3" name="nama" placeholder="Jawaban anda" value="{{ old('nama') }}">
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->  
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Jurusan <span class="text-danger font-size-sm">*</span></label>
                            <input type="text" class="form-control mt-3" name="jurusan" placeholder="Jawaban anda" value="{{ old('jurusan') }}">
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Nama Kontak</label>
                            <input type="text" class="form-control mt-3" name="nama_kontak" placeholder="Jawaban anda" value="{{ old('nama_kontak') }}">
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">No Kontak</label>
                            <div class="input-icon">
                                <span>
                                    (62)
                                </span>
                                <input type="text" class="form-control mt-3 phone_with_ddd" name="no_kontak" placeholder="Jawaban anda" value="{{ old('no_kontak') }}">
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body"> 
                        <div class="form-group">
                            <label class="font-size-h4">Jenis Kelamin <span class="text-danger font-size-sm">*</span></label>
                            <div class="radio-list mt-3">
                                <label class="radio">
                                    <input type="radio" name="jenkel" value="L" {{ old('jenkel') == 'L' ? 'checked' : '' }}>
                                    <span></span>Laki - laki
                                </label>
                                <label class="radio">
                                    <input type="radio" name="jenkel" value="P" {{ old('jenkel') == 'P' ? 'checked' : '' }}>
                                    <span></span>Perempuan
                                </label>                                
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Golongan Darah</label>
                            <input type="text" class="form-control mt-3" name="goldar" placeholder="Jawaban anda" value="{{ old('goldar') }}">
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Tanggal Dinyatakan Negatif</label>
                            <div class="input-group date mt-3">
                                <input type="text" id="tanggalNegatif" class="form-control" name="tgl_negatif" readonly="readonly" placeholder="Pilih Tanggal" value="{{ old('tgl_negatif') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Provinsi</label>
                            <select class="kt-select2 form-control mt-3" name="province_id" id="provinceSelect2">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Kabupaten</label>
                            <select class="kt-select2 form-control mt-3" name="regency_id" id="regencySelect2">
                                <option value="">Pilih Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Kecamatan</label>
                            <select class="kt-select2 form-control mt-3" name="district_id" id="districtSelect2">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Desa</label>
                            <select class="kt-select2 form-control mt-3" name="village_id" id="villageSelect2">
                                <option value="">Pilih Desa</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-size-h4">Kondisi</label>
                            <textarea class="form-control mt-3" name="kondisi" id="kondisi" rows="5">{{ old('kondisi') }}</textarea>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->  
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body"> 
                        <div class="form-group">
                            <label class="font-size-h4">Bisa Donor Plasma</label>
                            <div class="radio-list mt-3">
                                <label class="radio">
                                    <input type="radio" name="donor_plasma" value="T" {{ old('donor_plasma') == 'T' ? 'checked' : '' }}>
                                    <span></span>Ya
                                </label>
                                <label class="radio">
                                    <input type="radio" name="donor_plasma" value="F" {{ old('donor_plasma') == 'F' ? 'checked' : '' }}>
                                    <span></span>Tidak
                                </label>                                
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <button type="submit" class="btn btn-bg-success text-white font-weight-bold px-3">Kirim</button>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection

@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#tanggalNegatif').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "left bottom",
            locale: 'id',
            language: 'id',
            maxDate: '0',
            date: new Date(),
            endDate: new Date()
        });

        $('.kt-select2').select2();

        $('.phone_with_ddd').mask('000-0000-0000-00');

    });

    $("#provinceSelect2").select2().on('change', function() {
        var province = $('#provinceSelect2');
        $.ajax({
                url:"../api/regency/" + province.val(),
                type:'GET',
                success:function(data) {
                    var regency = $("#regencySelect2");
                    var district = $("#districtSelect2");
                    var village = $("#villageSelect2");
                    regency.empty();
                    district.empty();
                    village.empty();
                    regency.append($("<option></option>").attr("value", '').text('Pilih Kabupaten'));
                    district.append($("<option></option>").attr("value", '').text('Pilih Kecamatan'));
                    village.append($("<option></option>").attr("value", '').text('Pilih Desa'));
                    $.each(data, function(value, key) {
                        regency.append($("<option></option>").attr("value", key).text(value));
                    });
                    regency.select2();
                    var oldRegency = "{{ old('regency_id') ? old('regency_id') : '' }}";
                    if(oldRegency){
                        $("#regencySelect2").val("{{ old('regency_id') }}").trigger('change');
                    }
                }
            });
    }).trigger('change');

    $("#regencySelect2").select2().on('change', function() {
        var oldRegency2 = "{{ old('regency_id') ? old('regency_id') : ''}} ";
        if(oldRegency2 > 0){
            var regency = "{{ old('regency_id') }}";
        }else{
            var regency = $("#regencySelect2").val();    
        }
        $.ajax({
                url:"../api/district/" + regency,
                type:'GET',
                success:function(data) {
                    var district = $("#districtSelect2");
                    var village = $("#villageSelect2");
                    district.empty();
                    village.empty();
                    district.append($("<option></option>").attr("value", '').text('Pilih Kecamatan'));
                    village.append($("<option></option>").attr("value", '').text('Pilih Desa'));
                    $.each(data, function(value, key) {
                        district.append($("<option></option>").attr("value", key).text(value));
                    }); 
                    district.select2();
                    var oldDistrict = "{{ old('district_id') ? old('district_id') : '' }}";
                    if(oldDistrict){
                        $("#districtSelect2").val("{{ old('district_id') }}").trigger('change');
                    }
                }
            });
    }).trigger('change');

    $("#districtSelect2").select2().on('change', function() {
        var oldDistrict2 = "{{ old('district_id') ? old('district_id') : ''}} ";
        if(oldDistrict2 > 0){
            var district = "{{ old('district_id') }}";
        }else{
            var district = $("#districtSelect2").val();    
        }
        $.ajax({
                url:"../api/village/" + district,
                type:'GET',
                success:function(data) {
                    var village = $("#villageSelect2");
                    village.empty();
                    village.append($("<option></option>").attr("value", '').text('Pilih Desa'));
                    $.each(data, function(value, key) {
                        village.append($("<option></option>").attr("value", key).text(value));
                    }); 
                    village.select2();
                    var oldVillage = "{{ old('village_id') ? old('village_id') : '' }}";
                    if(oldVillage){
                        $("#villageSelect2").val("{{ old('village_id') }}").trigger('change');
                    }
                }
            });
    }).trigger('change');
</script>
@endpush