@extends('back-end.master')
@section('title')
    Cash in
@endsection
@section('mainContent')
<div class="page-content">
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

@endif


<div class="row"> 
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title mb-4">Cash in form</h4> 
              {{ Form::open(['route'=>'cash.store','method'=>'POST','enctype'=>'multipart/form-data']) }}
              <div class="form-group row mb-4">
                <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Date:</label>
                <div class="col-sm-10">
                  <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" id="horizontal-firstname-input">
                </div>
            </div>

              <div class="form-group row mb-4">
                <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Supplier:</label>
                <div class="col-sm-10">
                 <select name="supplier_id" class="form-control select2" id="">
                     <option value="" selected disabled>--select--</option> 
                     @foreach ($supplier as $supplier)
                          <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>  
                     @endforeach
                 </select>
                </div>
            </div>     
              
              <div class="form-group row mb-4">
                      <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Amount</label>
                      <div class="col-sm-10">
                        <input type="number" name="amount" class="form-control" id="horizontal-firstname-input">
                      </div>
                  </div>

                  
                  <div class="form-group row mb-4">
                      <label for="horizontal-email-input" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                          <input type="text" name="description" class="form-control" id="horizontal-email-input">
                      </div>
                  </div>  
                 
                   <div class="form-group row mb-4">
                      <label for="horizontal-email-input" class="col-sm-2  "> </label>
                      <div class="col-sm-10">  
                          <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                  </div>  
                  
              {{ Form::close('') }}
          </div>
      </div>
  </div>
</div>

{{-- for table --}}
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
                      <th>Date.</th>
                      <th>Supplier</th>
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
                       <td><?php
                        $date=date_create($cash->date);
                        echo date_format($date,"d-M-Y");
                        ?> </td>
                       <td>{{ $cash->supplier->title }}</td>
                       <td>{{ $cash->amount }}</td>
                       <td>{{ $cash->description?$cash->description:'-' }}</td>
                       <td>
                        <a href="{{ route('cash.delete.alart',['id'=>$cash->cash_id]) }}"><i class="dripicons-trash text-danger" title="Click for delete"></i></a> 
                       </td> 
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