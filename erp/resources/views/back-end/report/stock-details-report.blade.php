@extends('back-end.master')
@section('title')
    In Stock Details
@endsection
@section('mainContent')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 
                        <div class="clearfix"> 
                        <h3 class="float-left mr-2"><span class="badge badge-secondary">{{ $stock->supplier->title }}</span></h3>
                        <h3 class=""><span class="badge badge-secondary">{{ $stock->date }}</span></h3>
                        </div>
          
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr> 
                                
                                <th>Item</th> 
                                <th>Color</th>  
                                <th>Size</th>  
                                <th>Quantity</th>  
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>  
                                 @foreach ($stocks as $stock)
                                 <tr> 
                                    <td>{{ $stock->item->title }}</td> 
                                    <td>{{ $stock->color->title }}</td> 
                                    <td>{{ $stock->size->title }}</td> 
                                    <td>{{ $stock->qty }}</td> 
                                    <td>Demo</td> 
                                </tr> 
                                 @endforeach
                               
                           
                            </tbody>
                        </table>
          
                    </div>
                </div>
            </div> <!-- end col -->
          </div>
    </div>
@endsection