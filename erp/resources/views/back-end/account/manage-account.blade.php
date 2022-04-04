@extends('back-end.master')
@section('title')
   Account manage
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
                                <th>Account</th>
                                <th>Amount</th> 
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                             @foreach ($accounts as $account)
                             <tr>
                                 <td>{{ $i++ }}</td> 
                                 <td>{{ $account->title }}</td> 
                                 <td><span class="badge badge-pill badge-soft-success font-size-12">{{ $account->get_amount - $account->pay_amount  }} \-</span> </td> 
                                <td > 
                                    {{-- <a href="{{ route('account-payment-details',['id'=>$account->id]) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View Details</a> --}}
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