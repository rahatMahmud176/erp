@extends('back-end.master')
@section('title')
    Size Manage
@endsection
@section('mainContent')
<div class="page-content">
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

@endif


<div class="row"> 
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title mb-4">Size form</h4> 
              {{ Form::open(['route'=>['size.update',$size->id],'method'=>'POST','enctype'=>'multipart/form-data']) }}
                @method('PUT') 
              <div class="form-group row mb-4">
                      <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Size Title</label>
                      <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="horizontal-firstname-input" value="{{ $size->title }}">
                      </div>
                  </div>
                  <div class="form-group row mb-4">
                      <label for="horizontal-email-input" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                          <input type="text" name="description" class="form-control" id="horizontal-email-input" value="{{ $size->description }}">
                      </div>
                  </div>  
                  <div class="form-group row mb-4">
                      <label for="horizontal-email-input" class="col-sm-2  ">Publication Status</label>
                      <div class="col-sm-10"> 
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" {{ $size->status==1?'checked':'' }}  type="radio" name="status" id="inlineRadio1" value="1">
                              <label class="form-check-label"   for="inlineRadio1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" {{ $size->status==0?'checked':'' }}  type="radio" name="status" id="inlineRadio2" value="0">
                              <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                            </div>
                             
                      </div>
                  </div>  
                   <div class="form-group row mb-4">
                      <label for="horizontal-email-input" class="col-sm-2  "> </label>
                      <div class="col-sm-10">  
                          <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                  </div>  
                  
              {{ Form::close('') }}
          </div>
      </div>
  </div>
</div> 
</div>
@endsection