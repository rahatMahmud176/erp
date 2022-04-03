@extends('back-end.master')
@section('title')
    Item View
@endsection
@section('mainContent')
<div class="page-content">
    <div class="card">
        <div class="card-header">
          Item View
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                  <tr class="row">
                    <th class="col-md-2">Title</th>
                    <td class="col-md-1">:-</td>
                    <td class="col-md-9">{{ $item->title }}</td>
                  </tr> 
                  <tr class="row">
                    <th class="col-md-2">Featured-Image</th>
                    <td class="col-md-1">:-</td>
                    <td class="col-md-9"><img src="{{ asset($item->featured_image) }}" width="50px" alt=""></td>
                  </tr> 
                  <tr class="row">
                    <th class="col-md-2">Slider-Image</th>
                    <td class="col-md-1">:-</td>
                    <td class="col-md-9"><img src="{{ asset($item->slider_image) }}" width="50px" alt=""></td>
                  </tr> 
                  <tr class="row">
                    <th class="col-md-2">Other-Images</th>
                    <td class="col-md-1">:-</td>
                    <td class="col-md-9">
                        @foreach ($otherImages as $img)
                         <img src="{{ asset($img->image) }}" width="50px" alt="">
                        @endforeach  
                    </td>
                  </tr> 

                    <tr class="row">
                        <th  class="col-md-2">Category</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">{{ $item->category->title }}</td>
                    </tr>
                    <tr class="row">
                        <th  class="col-md-2">Sub-Category</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">{{ $item->subCategory->title }}</td>
                    </tr>
                    <tr class="row">
                        <th  class="col-md-2">Colors</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">
                            @foreach ($itemColors as $value)
                            <span class="p-2 mr-2 text-white" style="background:{{ $value->colors->code }};">{{ $value->colors->title }}</span> 
                            @endforeach 
                        </td>
                    </tr>
                    <tr class="row">
                        <th  class="col-md-2">Sizes</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">
                            @foreach ($itemSizes as $value)
                            <span class="bg-dark p-1 text-white" > {{ $value->sizes->title }}</span> 
                            @endforeach 
                        </td>
                    </tr>
                   
                    <tr class="row">
                        <th  class="col-md-2">Short-Description</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">{{ $item->s_description}}</td>
                    </tr>
                    <tr class="row">
                        <th  class="col-md-2">Long-Description</th>
                        <td class="col-md-1">:-</td>
                        <td class="col-md-9">{!! $item->l_description !!}</td>
                    </tr>
                </tbody>
              </table>
        </div>
        <div class="card-footer text-muted">  
          <a href="{{ route('item.edit',$item->id) }}" class="p-2 btn btn-info float-right mr-2">Edit</a>
        </div>
      </div>
</div>
@endsection