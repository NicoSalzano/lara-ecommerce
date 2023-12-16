@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Brand</h1>
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
                  <h4>Edit the brand</h4>
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
                    <form action="{{route('admin.brand.update',$brands->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <div class="form-group">
                                <label>Preview</label>
                                <br>
                                <img src="{{asset($brands->logo)}}" alt="" width="200">
                            </div>
                            <label>Logo</label>
                            <input type="file" class="form-control"  name="logo">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{$brands->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$brands->status == 1 ? 'selected': ''}} value="1">Active</option>
                              <option {{$brands->status == 0 ? 'selected': ''}} value="0">Inactive</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="inputState">Featured</label>
                            <select id="inputState" class="form-control" name="featured">
                              <option {{$brands->featured == 1 ? 'selected': ''}}  value="1">Yes</option>
                              <option {{$brands->featured == 0 ? 'selected': ''}}  value="0">No</option>
                            </select>
                          </div>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                  
                </div>    
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection