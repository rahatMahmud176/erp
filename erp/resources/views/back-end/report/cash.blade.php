@extends('back-end.master')
@section('title')
    Cash Report
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
                                <th>Date</th> 
                                <th>Via</th> 
                                <th>Amount</th> 
                                <th>Description</th> 
                                <th>Action</th> 
                            </tr>
                            </thead>
          
                            @php
                                $i = 1;
                            @endphp
                            <tbody>  
                                 @foreach ($cashs as $cash)
                                 <tr>   
                                    <td> 
                                        <?php
                                        $date=date_create($cash->date);
                                        echo date_format($date,"d-M-Y");
                                        ?>  
                                    </td>
                                    <td>
                                         @if ($cash->sell_id)
                                             Sell Id: {{ $cash->sell_id.' (cash)' }} 
                                         @elseif($cash->supplier_id)
                                             {{ $cash->supplier->title.' (Supplier)' }}
                                         @elseif($cash->delivery_agent_id)
                                            {{ $cash->agent->title.' (D.Agent)' }}
                                         @endif
                                    </td>
                                    <td>{{ $cash->amount }} \- </td>
                                    <td>{{ $cash->description?$cash->description:'-' }}</td>
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