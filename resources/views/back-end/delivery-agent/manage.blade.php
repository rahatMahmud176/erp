@extends('back-end.master')
@section('title')
   Agent manage
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
                                <th>SL.</th> 
                                <th>Agent Name</th>
                                <th>Deu Amount</th> 
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                             @foreach ($agents as $agent)
                             <tr>
                                 <td>{{ $i++ }}</td> 
                                 <td>{{ $agent->title }}</td> 
                                 <td><span class="badge badge-pill badge-soft-danger font-size-12">{{ $agent->due }} \-</span> </td> 
                                <td > 
                                    <a href="{{ route('agent-payment-details',['id'=>$agent->id]) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View Details</a>
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