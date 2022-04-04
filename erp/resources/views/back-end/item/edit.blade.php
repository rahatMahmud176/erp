@extends('back-end.master')
@section('title')
    Edit Item
@endsection
@section('mainContent')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Item Form:-</h4>
                   
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Layouts</li>
                        </ol>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12"> 
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
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form grid layout</h4> 
                        {{ Form::open(['method'=>'POST','route'=>['item.update',$myItem->id],'enctype'=>'multipart/form-data']) }}
                        @method('PUT')
                            <div class="form-group">
                                <label for="formrow-firstname-input">Item Name:</label>
                                <input type="text" name="title" class="form-control" id="formrow-firstname-input" value="{{ $myItem->title }}">
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Category</label> 
                                        <select name="category_id" class="form-control select2" id="">
                                             @foreach ($categories as $item)
                                              <option {{ $myItem->category_id==$item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                             @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-password-input">Sub-Category</label>
                                        <select name="sub_category_id" class="form-control select2" id="">
                                            @foreach ($subCategories as $item)
                                             <option {{ $myItem->sub_category_id==$item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formrow-password-input">Brand</label>
                                        <select name="brand_id" class="form-control select2" id="">
                                            @foreach ($brands as $item)
                                            <option {{ $myItem->brand_id==$item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                           @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="formrow-inputCity">Short Description</label> 
                                        <textarea name="s_description" class="form-control" id="" cols="30" rows="3">{{ $myItem->s_description }}</textarea>
                                    </div>
                                </div> 
                            </div>  
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Horizontal form layout</h4> 
                          
                            <div class="form-group row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Colors</label>
                                <div class="col-sm-9"> 
                                    <select name="color_id[]" class="form-control select2 select2-multiple" multiple="multiple" id="">
                                        @foreach ($colors as $item)
                                        <option  @foreach ($itemColors as $itemColor)
                                        {{ $itemColor->color_id==$item->id?'selected':'' }}
                                        @endforeach value="{{ $item->id }}">{{ $item->title }}</option>
                                       @endforeach 
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sizes</label>
                            <div class="col-sm-9"> 
                                <select name="size_id[]" class="form-control select2 select2-multiple" multiple="multiple" id="">
                                    @foreach ($sizes as $item)
                                        <option @foreach ($itemSizes as $itemSize)
                                            {{ $itemSize->size_id==$item->id?'selected':'' }}
                                        @endforeach value="{{ $item->id }}">{{ $item->title }}</option>
                                       @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9"> 

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-default">Purchase</span>
                                    </div>
                                    <input type="text" name="purchase_price" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $myItem->purchase_price }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Sell</span>
                                      </div>
                                      <input type="text" name="sell_price" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $myItem->sell_price }}">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-default">Re-Seller Price</span>
                                    </div>
                                    <input type="text" name="re_sell_price" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $myItem->re_sell_price }}">
                                   </div>

                            </div>
                        </div>
                            <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9"> 
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" checked value="1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Published
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="0">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      Unpublished
                                    </label>
                                  </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Featured Image</h4>
                        <p class="card-title-desc">The file input is the most gnarly of the bunch and </p>
                        <div class="custom-file">
                            <input type="file" name="featured_image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Slider Image</h4>
                        <p class="card-title-desc">The file input is the most gnarly of the bunch and </p>
                        <div class="custom-file">
                            <input type="file" name="slider_image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Others Image</h4>
                        <p class="card-title-desc">The file input is the most gnarly of the bunch and </p>
                        <div class="custom-file">
                            <input type="file" name="other_image[]" class="custom-file-input" multiple id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">  
                        <label for="">Long Description</label>
                            <textarea name="l_description" class="container-fluid form-control summernote" id="">{{ $myItem->l_description }}</textarea>
                         
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">  
                            <button type="submit" class="btn btn-primary container-fluid mb-2">Submit</button> 
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
        <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
@endsection