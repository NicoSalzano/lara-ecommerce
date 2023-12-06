@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Child-category</h1>
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
                  <h4>Update child-category</h4>
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
                    <form action="{{route('admin.child-category.update', $childCategory->id)}}" method="POST" >
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{$childCategory->name}}" name="name">
                        </div>
                        <div class="form-group">
                          <label for="inputState">Category</label>
                          <select id="inputState" class="form-control select main-category" name="category">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                            {{-- {{$category->id == $childCategory->category_id ? 'selected': ''}} QUESTA LINEA DI CODICE FARA IN MODO CHE NELLA VISTA DELL EDIT NEL CAMPO DELLA CATYEGORIA VERRA GIA SELEZIONATO IL VALORE APPARTENENTE AL DATO CHE VOGLIAMO MODIFICARE --}}
                            <option {{$category->id == $childCategory->category_id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="inputState">Sub-Category</label>
                          <select id="inputState" class="form-control select sub-category" name="sub_category">
                            <option value="">Select</option>
                            @foreach ($subCategories as $el )
                            <option {{$el->id == $childCategory->sub_category_id ? 'selected': ''}} value="{{$el->id}}">{{$el->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$childCategory->status == 1 ? 'selected': ''}} value="1">Active</option>
                              <option {{$childCategory->status == 0 ? 'selected': ''}} value="0">Inactive</option>
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

{{-- SCRIPT PER MOSTARE NELLA SELECT SOLO LA SUB-CATEGORIA CHE E IN RELAZIONE ALLA CATEGORIA --}}

@push('scripts')
      <script>
        $(document).ready(function() {
          $('body').on('change', '.main-category', function(e){
          //  creo una variabile da cui catturo l id della categoria selezionata
            let id = $(this).val();
            $.ajax({
              method: 'GET',
              url: "{{route('admin.get-subcategories')}}",
              data: {
                id:id
              },
              success:function(data){
                // console.log(data);
                // modifico prima l html e poi appendo l option su cui faccio partire il foreach, in questo modo vedro solo la categoria relazionata
                $('.sub-category').html('<option value="">Select</option>')
                $.each(data, function(i,item){
                  // console.log(item.name);
                  $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                })
              },
              error:function(xhr, status, error){
                console.log(error);
              }
            })
          })
        })
      </script>
@endpush