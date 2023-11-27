@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Slider</h1>
        </div>

        <div class="section-body">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-header">
                  <h4>Create New</h4>
                  <div class="card-header-action">
                      {{-- <a href="{{route('admin.slider.create')}}" class="btn btn-primary">Create New</a> --}}
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="" method="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" name="type">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Static price</label>
                            <input type="number" class="form-control" name="static_price">
                        </div>
                        <div class="form-group">
                            <label>Button Url</label>
                            <input type="text" class="form-control" name="#">
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" class="form-control" name="#">
                        </div>
                        <div class="form-group">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                              <option>Active</option>
                              <option>Inactive</option>
                            </select>
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