@extends('Vendor.layouts.master')

@section('content')
<!--=============================
    DASHBOARD START
    ==============================-->
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('Vendor.layouts.sidebar')
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <span class="alert alert-danger">{{$error}}</span>
        @endforeach
    @endif
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Create product</h3>
                    <div class="wsus__dashboard_profile">
                      
                        <div class="wsus__dash_pro_area">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</section>
@endsection
