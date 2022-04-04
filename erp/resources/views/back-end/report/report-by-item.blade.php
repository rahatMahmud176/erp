@extends('back-end.master')
@section('title')
    Item Details Stock
@endsection
@section('mainContent')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 
          
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th> 
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
                             @foreach ($items as $item)
                             <tr>
                                 <td>{{ $i++ }}</td>
                                <td>{{ $item->item->title }}</td>
                                <td>{{ $item->color->title }}</td>
                                <td>{{ $item->size->title }}</td>
                                <td>{{ $item->qty }}</td>
                                <td><a href="{{ route('report.show',$item->id) }}">Details</a></td> 
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