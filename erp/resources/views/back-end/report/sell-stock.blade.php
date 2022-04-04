@extends('back-end.master')
@section('title')
    Sell Stock Report
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
                                <th>Sell ID</th> 
                                <th>Date</th> 
                                <th>Supplier</th> 
                                <th>Challan</th>  
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>  
                                 @foreach ($sells as $sell)
                                 <tr> 
                                 <td>{{ $sell->id }}</td>
                                 <td><?php
                                    $date=date_create($sell->date);
                                    echo date_format($date,"d-M-Y");
                                ?></td> 
                                 <td>{{ $sell->customer }}</td>
                                 <td>{{ $sell->challan }}</td>
                                <td>
                                    <a href="{{ route('sell-details-report',['id'=>$sell->id]) }}"> <i class="far fa-eye"></i> </a> 
                                    <a href="{{ route('sell.delete.alart',['id'=>$sell->id]) }}"><i class="dripicons-trash text-danger" title="Click for delete"></i></a> 
                                    <a href="{{ route('sell.edit',$sell->id) }}"><i class="dripicons-document-edit text-info" title="Click for edit"></i></a>  
                                </td>  
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