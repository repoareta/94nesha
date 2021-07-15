@extends('layouts.layout-admin')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
    
<div class="container">
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
    <div class="card card-custom">
        <div class="card-header" style="">
            <div class="card-title">
                <h3 class="card-label">Profil Saya</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profil.update') }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="font-size-h4">Nama <span class="text-danger font-size-sm">*</span></label>
                    <input type="text" class="form-control mt-3" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <a href="{{ route('admin.profil.password') }}" class="btn btn-primary">
                        Change Password
                    </a>
                </div>
                <div class="form-group">
                    <label class="font-size-h4">Email <span class="text-danger font-size-sm">*</span></label>
                    <input type="email" class="form-control mt-3" name="email" value="{{  Auth::user()->email }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>   
</div>
@endsection
