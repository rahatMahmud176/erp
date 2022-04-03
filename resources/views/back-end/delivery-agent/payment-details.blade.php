@extends('back-end.master')
@section('title')
   Agent Payments Details
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
                                <th>Date</th>
                                <th>Custoemr-(Sell ID)</th>
                                <th>Challan No.</th>
                                <th>Amount</th>
                                <th>Status</th> 
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                             @foreach ($agentsDetails as $agent)
                             <tr>
                                 <td><?php
                                    $date=date_create($agent->date);
                                    echo date_format($date,"d-M-Y");
                                ?></td> 
                                 <td>{{ $agent->sell->customer.'-'.$agent->sell_id }}</td> 
                                 <td>{{ $agent->challan }}</td> 
                                 <td>{{ $agent->amount }} \-</td> 
                                 <td><span class="badge badge-pill badge-soft-danger font-size-12">{{ $agent->status==0?'Pending':'' }}</span> </td> 
                                <td > 
                                    <a href="{{ route('received-payment',['id'=>$agent->id]) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Recieve Now</a>
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