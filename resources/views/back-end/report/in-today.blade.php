@extends('back-end.master')
@section('title')
    In Today
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
                                <th>SL.</th> 
                                <th>Item</th> 
                                <th>Color</th> 
                                <th>Size</th> 
                                <th>Quantity</th> 
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>  
                                 @foreach ($stocks as $stock)
                                 <tr>  
                                 <td>{{ $i++ }}</td>
                                 <td>{{ $stock->item->title }}</td>
                                 <td>{{ $stock->color->title }}</td>
                                 <td>{{ $stock->size->title }}</td>
                                 <td>{{ $stock->qty }}</td> 
                                <td>
                                    <a href="{{ route('stock-details-report',['id'=>$stock->id]) }}"> <i class="far fa-eye"></i> </a> 
                                    <a href="{{ route('stock.delete.alart',['id'=>$stock->id]) }}"><i class="dripicons-trash text-danger" title="Click for delete"></i></a> 
                                    <a href="{{ route('stock.edit',$stock->id) }}"><i class="dripicons-document-edit text-info" title="Click for edit"></i></a>  
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