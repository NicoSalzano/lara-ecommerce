@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Variant</h1>
        </div>
        @if (session('message'))
                <div class="alert alert-success mt-3  ">
                  {{session('message')}}
                </div>
                @endif

        <div class="section-body">
          <div class="row">
            @if ($errors->any())
                    @foreach ($errors->all() as $error )
                        <div class="alert alert-danger mt-2">{{$error}}</div>
                    @endforeach
            @endif  
            <div class="col-12 ">
              <div class="card">
                <div class="card-header">
                  <h4>Create New Variant for:</h4>
                  <div class="card-header-action">
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="{{route('admin.products-variant.store')}}" method="POST" >
                      @csrf
                        {{-- <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{old('name')}}" name="name">
                        </div> --}}
                        <div id="rows-container">
                            <div class="wrap">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                     <div class="input-group mb-3">
                                      <input type="text" class="form-control"  name="name">
                                      <input type="hidden" name="product" value="{{request()->product}}">
                                      <div class="input-group-append">
                                        {{-- <button class="btn btn-success ml-3" onclick="addRow()" type="button"><i class="ion-plus-round"></i></button> --}}
                                        {{-- <button class="btn btn-danger ml-1" onclick="rmvRow(this)" type="button"><i class="ion-trash-a"></i></button> --}}
                                      </div>
                                  </div>
                                 </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="status" >
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                 </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>    
              </div>
            </div>
          </div>
        </div>
      </section>
      {{-- <script>
         function addRow() {
          let newRow = `
                        <div class="wrap">
                            <div class="form-group">
                                <label for="">Nome</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control"  name="name[]">
                                    <input type="hidden" name="product[]" value="{{request()->product}}">

                                      <div class="input-group-append">
                                    <button class="btn btn-success ml-3" onclick="addRow()" type="button"><i class="ion-plus-round"></i></button>
                                    <button class="btn btn-danger ml-1" onclick="rmvRow(this)" type="button"><i class="ion-trash-a"></i></button> 
                                    </div>
                                </div>
                                </div>
                            <div class="form-group">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control" name="status[]">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                </div>
                        </div>
                        `;
                      $(`#rows-container`).append(newRow);
        }
        function rmvRow(button) {
          $(button).closest('.wrap').remove();
        }
      </script> --}}
@endsection