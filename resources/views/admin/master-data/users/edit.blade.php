@extends('layouts.layout-admin')

@section('breadcrumb')
    {{ Breadcrumbs::render('users-edit', $data) }}
@endsection

@push('page-styles')

@endpush

@section('content')
<div class="container-fluid">
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
    <!--begin::Card-->
    <div class="card card-custom" id="kt_page_sticky_card">
        <div class="card-header justify-content-between align-items-center">
            <div class="card-title">
                <h3 class="card-label">Edit Data User 
                <i class="mr-2"></i>
                <small class="">Data User</small></h3>
            </div>
            <a href="{{ route('admin.master.users.') }}" class="btn btn-light-primary font-weight-bolder">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.master.users.update', $data->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="font-size-h4">Nama <span class="text-danger font-size-sm">*</span></label>
                    <input type="text" class="form-control mt-3" name="name" value="{{ $data->name }}">
                </div>
                <div class="form-group">
                    <a href="{{ route('admin.master.users_pass.edit', $data->id) }}" class="btn btn-primary">
                        Change Password
                    </a>
                </div>
                <div class="form-group">
                    <label class="font-size-h4">Email <span class="text-danger font-size-sm">*</span></label>
                    <input type="email" class="form-control mt-3" name="email" value="{{ $data->email }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
</div>
@endsection

@push('page-scripts')
@endpush
