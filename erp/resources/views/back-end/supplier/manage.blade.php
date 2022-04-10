@extends('back-end.master')
@section('title')
    Supplier manage
@endsection

@section('mainContent')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
          
                        <h4 class="card-title">Default Datatable</h4>
                        <p class="card-title-desc">DataTables has most features enabled by
                            default, so all you need to do to use it with your own tables is to call
                            the construction function: <code>$().DataTable();</code>.
                        </p>
          
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th>
                                <th>Description</th> 
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                             @foreach ($suppliers as $item)
                             <tr>
                                 <td>{{ $i++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td> 
                                <td>
                                    @if ($item->status ==1) 
                                        <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Published 
                                    @else 
                                        <i class="bx bx-block font-size-16 align-middle mr-2"></i> Unpublished
                                     @endif
                                </td>
                                <td class="text-right"> 
                                    <a href="{{ route('updateSupplierStatus',['id'=>$item->id]) }}"><i class="fas fa-arrow-alt-circle-up {{ $item->status==1?'text-danger':'text-success' }}" title="{{ $item->status==1?'Click for Unpublished':'Click for Published' }}">   </i></a>
                                     <a href="{{ route('supplier.delete.alart',['id'=>$item->id]) }}"><i class="dripicons-trash text-danger" title="Click for delete"></i></a> 
                                     <a href="{{ route('supplier.edit',$item->id) }}"><i class="dripicons-document-edit text-info" title="Click for edit"></i></a>  
                                </td> 
                                {{-- {{ Form::open(['route'=>['supplier.destroy',$item->id],'method'=>'POST','id'=>'supplierDelete']) }}
                                    @method('DELETE')
                                {{ Form::close() }} --}}
                            </tr>
                             @endforeach
                           
                            
                            </tbody>
                        </table>
          
                    </div>
                </div>
            </div> <!-- end col -->
          </div> <!-- end row -->
    </div>
@endsection