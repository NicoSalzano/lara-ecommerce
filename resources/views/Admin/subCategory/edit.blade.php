@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Sub-category</h1>
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
                  <h4>Edit sub-category</h4>
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
                    <form action="{{route('admin.sub-category.update', $subCategories->id)}}" method="POST" >
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{$subCategories->name}}" name="name">
                        </div>
                        <div class="form-group">
                          <label for="inputState">Category</label>
                          <select id="inputState" class="form-control select" name="category">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                            <option {{$category->id == $subCategories->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$subCategories->status == 1 ? 'selected': ''}} value="1">Active</option>
                              <option {{$subCategories->status == 0 ? 'selected': ''}}  value="0">Inactive</option>
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