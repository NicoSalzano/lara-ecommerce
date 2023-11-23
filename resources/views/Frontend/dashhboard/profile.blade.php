@extends('Frontend.dashhboard.layouts.master')

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
    @include('Frontend.dashhboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile-----completamente da modificare</h3>
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
                <h4>basic information</h4>
               
                  
                    <form action="{{route('updateProfile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="wsus__dash_pro_img">
                                  <img src="{{Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg')}}" alt="img" class="img-fluid w-100">
                                  <input type="file" name="image">
                                </div>
                              </div>
                            <div class="col-md-12 mt-5">
                              <div class="wsus__dash_pro_single">
                                <i class="fas fa-user-tie"></i>
                                <input name="name" type="text" placeholder="Name" value="{{Auth::user()->name}}">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="wsus__dash_pro_single">
                                <i class="fal fa-envelope-open"></i>
                                <input name="email" type="email" placeholder="Email" value="{{Auth::user()->email}}">
                              </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                          </div>
                    </form>
                    
                    <form action="{{route('updatePassword')}}" method="POST">
                        @csrf
                        <div class="wsus__dash_pass_change mt-2">
                            <div class="row">
                              <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                  <i class="fas fa-unlock-alt"></i>
                                  <input type="password" placeholder="Current Password" name="current_password">
                                </div>
                              </div>
                              <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                  <i class="fas fa-lock-alt"></i>
                                  <input type="password" placeholder="New Password" name="password">
                                </div>
                              </div>
                              <div class="col-xl-4">
                                <div class="wsus__dash_pro_single">
                                  <i class="fas fa-lock-alt"></i>
                                  <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                              </div>
                              <div class="col-xl-12">
                                <button class="common_btn" type="submit">upload</button>
                              </div>
                            </div>
                          </div>
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