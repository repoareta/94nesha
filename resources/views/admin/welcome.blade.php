@extends('layouts.layout-admin')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    
<div class="container">
    <div class="card card-custom" id="kt_page_sticky_card">
        <div class="card-body text-center">
            <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
        </div>
    </div>   
</div>
@endsection
