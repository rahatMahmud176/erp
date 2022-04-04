@extends('back-end.master')
@section('title')
    Edit Sell
@endsection
@section('mainContent')
    <div class="page-content">
        {{ Form::open(['route'=>['sell.update',$sell->id],'method'=>'POST']) }}
        @method('PUT')
        <div class="card col-md-6 mx-auto"> 
            <div class="card-body">
               <table>
                   <tr>
                       <th>Date:</th>
                       <td><input class="form-control" type="date" name="date" id="" required value="{{ $sell->date }}"></td>
                   </tr>
                   <tr>
                       <th>Challan:</th>
                       <td><input class="form-control" type="text" name="challan" id="" required value="{{ $sell->challan }}"></td>
                   </tr>
                   <tr>
                    <th>Delivery Agent:</th>
                    <td>
                     <select name="agent" class="select2 form-control" id="">
                             <option value="0">Cash</option>
                         @foreach ($deliveriAgents as $item)
                             <option {{ $sell->delivery_agent == $item->id?'selected':''  }} value="{{ $item->id }}">{{ $item->title }}</option> 
                         @endforeach 
                     </select>
                     </td>
                </tr>
                   <tr>
                       <th>Customer:</th>
                       <td>
                            
                            <input type="text" class="form-control select2" name="customer" value="{{ $sell->customer }}">
                            
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
                            <th><button type="button" class="btn btn-success add-stock-row">+</button></th>
                           </tr> 
                       </thead>
                       <tbody class="" id="stockBody">
                         @php
                             $i = 11000
                         @endphp
                           @foreach ($sellDetails as $sellDetail)
                               
                          
                           <tr> 
                               <td> 
                                   <select name="stock[{{ $i }}][item]" class="select2 form-control " id="selectSellItem0" data-id="{{ $i }}">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($items as $item) 
                                        <option {{ $sellDetail->item_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option> 
                                    @endforeach 
                                   </select>
                                 </td>
                               <td> 
                                   <select name="stock[{{ $i }}][color]" class="select2 form-control" id="color{{ $i }}">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($colors as $item)
                                         <option {{ $sellDetail->color_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option> 
                                     @endforeach
                                   </select>
                                 </td>
                               <td> 
                                   <select name="stock[{{ $i }}][size]" class="select2 form-control" id="size{{ $i }}">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($sizes as $item)
                                        <option {{ $sellDetail->size_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option> 
                                    @endforeach
                                   </select>
                                 </td> 
                                 <td> <input type="text" class="form-control take-price" name="stock[{{ $i }}][price]" id="price{{ $i }}" data-id="{{ $i }}" value="{{ $sellDetail->price }}"> </td>
                                 <td> <input type="text" class="form-control take-amount" name="stock[{{ $i }}][qty]" id="qty{{ $i }}" data-id="{{ $i }}" value="{{ $sellDetail->qty }}"> </td>  
                                 <td> <input type="text" class="form-control" name="stock[{{ $i }}][total]" id="total{{ $i }}" value="{{ $sellDetail->price * $sellDetail->qty }} "> </td> 
                                 <td> <button type="button" class="btn btn-danger remove-stock-row">-</button></td>
                           </tr>
                           {{ $i++ }}
                           @endforeach
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