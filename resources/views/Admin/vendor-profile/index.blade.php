@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Vendor Profile</h1>
        </div>
        @if (session('message'))
                <div class="alert alert-success mt-3  ">
                  {{session('message')}}
                </div>
                @endif

        <div class="section-body">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-header">
                  <h4>Update Vendor Profile</h4>
                  @if ($errors->any())
                          @foreach ($errors->all() as $error )
                              <div class="alert alert-danger mt-2">{{$error}}</div>
                          @endforeach
                  @endif  
                  <div class="card-header-action">
                      {{-- <a href="{{route('admin.slider.create')}}" class="btn btn-primary">Create New</a> --}}
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img src="{{asset($profile->banner)}}" alt="" width="200">
                        </div>
                        <div class="form-group">
                            <label>Banner</label>
                            <input type="file" class="form-control" value="{{$profile->banner}}" name="banner">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" value="{{$profile->phone}}" name="phone">
                        </div>
                        <div class="form-group">
                          <label>Shop Name</label>
                          <input type="text" class="form-control" value="{{$profile->shop_name}}" name="shop_name">
                      </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{$profile->email}}" name="email">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="{{$profile->address}}" name="address">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text"   name="description" class="summernote-simple">{{$profile->description}}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" value="{{$profile->fb_link}}" name="fb_link">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" value="{{$profile->tw_link}}" name="tw_link">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" value="{{$profile->insta_link}}" name="insta_link">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                  
                </div>    
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection