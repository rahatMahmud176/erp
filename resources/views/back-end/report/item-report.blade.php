@extends('back-end.master')
@section('title')
    Item Stock
@endsection
@section('mainContent')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 
                        @php
                           $quantity = 0;
                           $i = 1;
                        @endphp
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th> 
                                <th>Quantity </th>  
                                <th class="text-right">Action</th>
                            </tr>
                            </thead> 
                            <tbody>
                             @foreach ($items as $item)
                             <tr>
                                 <td>{{ $i++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->qty }}</td>
                                <td><a href="{{ route('report.show',$item->id) }}">Details</a></td>  
                            </tr>
                            @php
                                $quantity = $quantity + $item->qty;
                            @endphp
                             @endforeach 
                             <tr>
                                <th>Total.</th>
                                <th>=</th> 
                                <th class="text-success">{{ $quantity }} Pcs.</th>  
                                <th class="text-right">Action</th>
                            </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> <!-- end col -->
          </div>
    </div>
@endsection