@extends('Vendor.layouts.master')

@section('content')
<!--=============================
    DASHBOARD START
    ==============================-->
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('Vendor.layouts.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Shop Profile</h3>
                    <div class="wsus__dashboard_profile">
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
                        <div class="wsus__dash_pro_area">
                            <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                  <div class="form-group">
                                      <label>Preview</label>
                                      <br>
                                      <img src="{{asset($profile->banner)}}" alt="" width="200">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Banner</label>
                                      <input type="file" class="form-control" value="{{$profile->banner}}" name="banner">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Shop name</label>
                                      <input type="text" class="form-control" value="{{$profile->shop_name}}" name="shop_name">
                                  </div>
                                  <div class="form-group wsus_input">
                                    <label>Phone</label>
                                    <input type="number" class="form-control" value="{{$profile->phone}}" name="phone">
                                </div>
                                  <div class="form-group wsus_input">
                                      <label>Email</label>
                                      <input type="email" class="form-control" value="{{$profile->email}}" name="email">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Address</label>
                                      <input type="text" class="form-control" value="{{$profile->address}}" name="address">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Description</label>
                                      <textarea type="text"   name="description" class="summernote-simple">{{$profile->description}}</textarea>
                                      
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Facebook</label>
                                      <input type="text" class="form-control" value="{{$profile->fb_link}}" name="fb_link">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Twitter</label>
                                      <input type="text" class="form-control" value="{{$profile->tw_link}}" name="tw_link">
                                  </div>
                                  <div class="form-group wsus_input">
                                      <label>Instagram</label>
                                      <input type="text" class="form-control" value="{{$profile->insta_link}}" name="insta_link">
                                  </div>
                                  
                                  <button type="submit" class="btn btn-success">Update</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!--=============================
        DASHBOARD START
        ==============================-->
        @endsection