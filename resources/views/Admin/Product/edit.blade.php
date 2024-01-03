@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Product</h1>
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
                  <h4>Create New</h4>
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
                    <form action="{{route('admin.products.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                                <br>    
                            <img src="{{asset($products->thumb_image)}}" alt="" width="200">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" value="{{$products->thumb_image}}" name="thumb_image">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{$products->name}}" name="name">
                        </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="">Select</option>
                                      @foreach ($categories as $category)
                                        <option  {{$category->id == $products->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Sub-category</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">
                                      <option value="">Select</option>
                                      @foreach ($subCategories as $subCategory )
                                          <option {{$subCategory->id == $products->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Child-category</label>
                                    <select id="inputState" class="form-control child-category" name="child_category">
                                      <option value="">Select</option>
                                      @foreach ($childCategories as $childCategory )
                                          <option {{$childCategory->id == $products->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputState">Brand</label>
                            <select id="inputState" class="form-control" name="brand">
                              <option value="">Select</option>
                              @foreach ($brands as $brand )
                                <option {{$brand->id == $products->brand_id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" value="{{$products->price}}" name="price">
                        </div>
                        <div class="form-group">
                            <label>Offer Price</label>
                            <input type="number" class="form-control" value="{{$products->offer_price}}" name="offer_price">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer Start Date </label>
                                    <input type="text" class="form-control datepicker" value="{{$products->offer_start_date}}" name="offer_start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer End Date</label>
                                    <input type="text" class="form-control datepicker" value="{{$products->offer_end_date}}" name="offer_end_date">
                                </div>
                            </div>
                        </div>

                          {{-- sku e il codice a barre --}}
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="number" class="form-control" value="{{$products->sku}}" name="sku">
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" min="0" value="{{$products->qty}}" name="qty">
                        </div>
                        <div class="form-group">
                            <label>Video Link</label>
                            <input type="text" class="form-control" value="{{$products->video_link}}" name="video_link">
                        </div>
                        <div class="form-group">
                            <label>Short description</label>
                            <textarea class="form-control" value="{{old('short_description')}}" name="short_description">{{$products->short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Long description</label>
                            <textarea class="form-control summernote-simple" value="{{old('long_description')}}" name="long_description">{{$products->long_description}}</textarea>
                        </div>
                             <div class="form-group">
                                <label for="inputState">Product type</label>
                                <select id="inputState" class="form-control" name="product_type">
                                    <option value="0">Select</option>
                                    <option {{$products->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New arrival</option>
                                    <option {{$products->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">Featured</option>
                                    <option {{$products->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Best Product</option>
                                    <option {{$products->product_type == 'top_product' ? 'selected' : ''}} value="top_product">Top Product</option>
                                </select>
                             </div>
                        <div class="form-group">
                            <label>SEO title</label>
                            <input class="form-control" value="{{$products->seo_title}}" name="seo_title">
                        </div>
                        <div class="form-group">
                            <label>SEO description</label>
                            <textarea class="form-control summernot" value="{{old('seo_description')}}" name="seo_description">{{$products->seo_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$products->status == 1 ? 'selected': ''}} value="1">Active</option>
                              <option {{$products->status == 0 ? 'selected': ''}} value="0">Inactive</option>
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
@push('scripts')
      <script>
        $(document).ready(function() {
          $('body').on('change', '.main-category', function(e){
            $('.child-category').html('<option value="">Select</option>')

          //  creo una variabile da cui catturo l id della categoria selezionata
            let id = $(this).val();
            $.ajax({
              method: 'GET',
              url: "{{route('admin.product.get-subcategories')}}",
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
           // get child categories
           $('body').on('change', '.sub-category', function(e){
          //  creo una variabile da cui catturo l id della categoria selezionata
            let id = $(this).val();
            $.ajax({
              method: 'GET',
              url: "{{route('admin.product.get-childcategories')}}",
              data: {
                id:id
              },
              success:function(data){
                // console.log(data);
                // modifico prima l html e poi appendo l option su cui faccio partire il foreach, in questo modo vedro solo la categoria relazionata
                $('.child-category').html('<option value="">Select</option>')
                $.each(data, function(i,item){
                  // console.log(item.name);
                  $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
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