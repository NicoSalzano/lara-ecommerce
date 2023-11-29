@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Slider</h1>
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
                  <h4>Edit</h4>
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
                    <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img src="{{asset($slider->banner)}}" alt="" width="200">
                        </div>
                        <div class="form-group">
                            <label>Banner</label>
                            <input type="file" class="form-control" name="banner">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" value="{{$slider->type}}" name="type">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" value="{{$slider->title}}" name="title">
                        </div>
                        <div class="form-group">
                            <label>Startin price</label>
                            <input type="number" class="form-control" value="{{$slider->starting_price}}" name="starting_price">
                        </div>
                        <div class="form-group">
                            <label>Button Url</label>
                            <input type="text" class="form-control" value="{{$slider->btn_url}}" name="btn_url">
                        </div>
                        <div class="form-group">
                            <label>Serial</label>
                            <input type="number" class="form-control" value="{{$slider->serial}}" name="serial">
                        </div>
                        <div class="form-group">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$slider->status == 1 ? 'selected': ''}} value="1">Active</option>
                              <option {{$slider->status == 0 ? 'selected': ''}} value="0">Inactive</option>
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