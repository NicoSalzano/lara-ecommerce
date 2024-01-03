@extends('Admin.layouts.master')

@section('content')
     <!-- Main Content -->
     
        <section class="section">
          <div class="section-header">
            <h1>Product Image Gallery</h1>
          </div>

          <div class="section-body">
                @if (session('message'))
                <div class="alert alert-success mt-3  ">
                  {{session('message')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 ">
                      <div class="card">
                        <div class="card-header">
                          <h4>Product: {{$products->name}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.products-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Image <code>Multi image supported</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{$products->id}}">
                              </div>
                              <button type="submit" class="btn btn-success">Upload</button>
                            </form>
                        </div>    
                      </div>
                    </div>
                  </div>
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Image index</h4>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </section>
      
@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  <script>
    $(document).ready(function(){
      $('body').on('click', '.change-status', function(){
        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        $.ajax({
          url: "{{route('admin.product.change-status')}}",
          method:'PUT',
          data: {
            status: isChecked,
            id:id
          },
          success: function(data){
            data.message;
          },
          error: function(xhr, status, error){
            console.log(error);
          }
        })
      })
    })
  </script>
@endpush