@extends('Admin.layouts.master')

@section('content')
     <!-- Main Content -->
     
        <section class="section">
          <div class="section-header">
            <h1>Slider</h1>
          </div>

          <div class="section-body">
                @if (session('message'))
                <div class="alert alert-success mt-3  ">
                  {{session('message')}}
                </div>
                @endif
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Slider index</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.slider.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Create New</a>
                    </div>
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
@endpush