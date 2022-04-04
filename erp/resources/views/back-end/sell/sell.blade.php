@extends('back-end.master')
@section('title')
    Sell
@endsection
@section('mainContent')
    <div class="page-content">
        {{ Form::open(['route'=>'sell.store','method'=>'POST']) }}
        <div class="card col-md-6 mx-auto"> 
            <div class="card-body">
               <table>
                   <tr>
                       <th>Date:</th>
                       <td><input class="form-control" type="date" name="date" value="{{ date('Y-m-d') }}" id="" required></td>
                   </tr>
                   <tr>
                       <th>Challan:</th>
                       <td><input class="form-control" type="text" name="challan" id="" required></td>
                   </tr>
                   <tr>
                       <th>Customer Name:</th>
                       <td>
                            <input type="text" class="form-control" name="customer">
                        </td>
                   </tr>
                   <tr>
                       <th>Delivery Agent:</th>
                       <td>
                        <select name="agent" class="select2 form-control" id="">
                                <option value="0">Cash</option>
                            @foreach ($deliveriAgents as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option> 
                            @endforeach 
                        </select>
                        </td>
                   </tr>
               </table>
            </div>
          </div>
          <div class="row">
            <div class="card col-md-12"> 
                <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr> 
                            <th>Item</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quntity</th>
                            <th>Total</th>
                            <th>Action</th>
                           </tr> 
                       </thead>
                       <tbody class="" id="sellBody">
                           <tr> 
                               <td> 
                                   <select name="stock[0][item]" class="select2 form-control selectSellItem " id="selectSellItem0" data-id="0">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($items as $item) 
                                        <option value="{{ $item->id }}">{{ $item->title }}</option> 
                                    @endforeach 
                                   </select>
                                 </td>
                               <td> 
                                   <select name="stock[0][color]" class="select2 form-control selectSellColor" data-id="0" id="color0">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($colors as $item)
                                         <option value="{{ $item->id }}">{{ $item->title }}</option> 
                                     @endforeach
                                   </select>
                                 </td>
                               <td> 
                                   <select name="stock[0][size]" class="select2 form-control selectSellSize" id="size0" data-id="0">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($sizes as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option> 
                                    @endforeach
                                   </select>
                                 </td> 
                                 <td> <input type="text" class="form-control take-price" name="stock[0][price]" id="price0" data-id="0"> </td>
                                 <td> <input type="text" class="form-control take-amount" name="stock[0][qty]" id="qty0" data-id="0"> </td>  
                                 <td> <input type="text" class="form-control" name="stock[0][total]" id="total0"> </td> 
                                 <td> <button type="button" class="btn btn-success add-sell-row">+</button></td>
                           </tr>
                       </tbody>
                   </table>

                </div>
              </div> 
          </div>
          <div class="card col-md-12"> 
            <div class="card-body">
                <button class="btn btn-info container-fluid">Submit</button>
            </div>
          </div>
        {{ Form::close() }}
    </div>
@endsection