<script src="{{ asset('/') }}assets/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="{{ asset('/') }}assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="{{ asset('/') }}assets/js/pages/dashboard.init.js"></script> 
         <!-- Required datatable js -->
        <script src="{{ asset('/') }}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('/') }}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!-- Datatable init js -->
        <script src="{{ asset('/') }}assets/js/pages/datatables.init.js"></script>
        <!-- form advanced -->
        <script src="{{ asset('/') }}assets/libs/select2/js/select2.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="{{ asset('/') }}assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
         <!-- form advanced init -->
         <script src="{{ asset('/') }}assets/js/pages/form-advanced.init.js"></script>
        <!-- Summernote js -->
        <script src="{{ asset('/') }}assets/libs/summernote/summernote-bs4.min.js"></script> 
        <!--Summernote init js -->
        <script src="{{ asset('/') }}assets/js/pages/form-editor.init.js"></script>
         <!-- materialdesign icon js-->
         <script src="{{ asset('/') }}assets/js/pages/materialdesign.init.js"></script>

        <!-- App js -->
        <script src="{{ asset('/') }}assets/js/app.js"></script>
        
        @include('sweetalert::alert')


<script>
        var i = 1;
$('tbody').on('change', '#selectItem', function() { 
        var itemId = $(this).val();
        var dataId = $(this).attr('data-id');
        // console.log('hi');
        //alert ('ok');
        //alert (itemId);
        $.ajax({
                type: 'GET',
                url : "{{ url('stock-info-by-item-id') }}",
                data: {id:itemId},
                dataType: 'json',
                success: function(res){
                                // console.log(res);
                        var colorSelect = $('#color'+dataId);
                                colorSelect.empty();
                        var colorOption = ''; 
                                $.each(res.colors, function(key, value){
                                colorOption += '<option value="'+value.id+'">'+value.title+'</option>'; 
                                });
                        colorSelect.append(colorOption);

                        var sizeSelect = $('#size'+dataId);
                                sizeSelect.empty();
                        var sizeOption = '';
                        $.each(res.sizes, function(key, value){
                                sizeOption += '<option value="'+value.id+'">'+value.title+'</option>'; 
                                });
                                sizeSelect.append(sizeOption);

                        var price = $('#price'+dataId);
                                price.val(res.price);
                }
        });
});

$(document).on('keyup','.take-amount', function(){
       var dataId = $(this).attr('data-id');
       var qty    = $(this).val();
       var price  = $('#price'+dataId).val();
       var res    = qty*price;
       var total  = $('#total'+dataId);
           total.val(res);
});
$(document).on('keyup','.take-price', function(){
       var dataId = $(this).attr('data-id');
       var price  = $(this).val();
       var qty    = $('#qty'+dataId).val();
       var res    = qty*price;
       var total  = $('#total'+dataId);
           total.val(res);
});

$(document).on('click','.add-stock-row', function(){
        $.ajax({
            type:'GET',
            url : "{{ url('all-stock-info') }}",
            data:'',
            dataType: 'json',
            success: function(res){
                    //console.log(res);
                    var tr = '';
            tr += '<tr>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][item]" class="select2 form-control " id="selectItem" data-id="'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.items, function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][color]" class="select2 form-control" id="color'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.colors,function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][size]" class="select2 form-control" id="size'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.sizes,function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>'; 
            tr += '<td> <input type="text" class="form-control take-price" name="stock['+i+'][price]" id="price'+i+'" data-id="'+i+'"> </td>';
            tr += '<td> <input type="text" class="form-control take-amount" name="stock['+i+'][qty]" id="qty'+i+'" data-id="'+i+'"> </td>'; 
            tr += '<td> <input type="text" class="form-control" name="stock['+i+'][total]" id="total'+i+'"> </td>'; 
            tr += '<td> <button type="button" class="btn btn-danger remove-stock-row">-</button></td>';
            tr += '</tr>'; 
            $('#stockBody').append(tr);
            $('.select2').select2();
            i++;
            }
        }); 
});
        $(document).on('click','.remove-stock-row', function(){
                 $(this).parent().parent().remove();
        }); 
        $(document).on('click','.add-sell-row', function(){ 
        $.ajax({
            type:'GET',
            url : "{{ url('all-sell-info') }}",
            data:'',
            dataType: 'json',
            success: function(res){
                   // console.log(res);
                    var tr = '';
            tr += '<tr>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][item]" class="select2 form-control selectSellItem " id="selectSellItem'+i+'" data-id="'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.items, function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][color]" class="select2 form-control selectSellColor" data-id="'+i+'" id="color'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.colors,function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>';
            tr += '<td>'; 
            tr += '<select name="stock['+i+'][size]" class="select2 form-control selectSellSize" data-id="'+i+'" id="size'+i+'">';
            tr += '<option value="" selected disabled>Select</option>';
            $.each(res.sizes,function(key,value){
                tr += '<option value="'+value.id+'">'+value.title+'</option>';
            }); 
            tr += '</select>';
            tr += '</td>'; 
            tr += '<td> <input type="text" class="form-control take-price" name="stock['+i+'][price]" id="price'+i+'" data-id="'+i+'"> </td>';
            tr += '<td> <input type="text" class="form-control take-amount" name="stock['+i+'][qty]" id="qty'+i+'" data-id="'+i+'"> </td>'; 
            tr += '<td> <input type="text" class="form-control" name="stock['+i+'][total]" id="total'+i+'"> </td>'; 
            tr += '<td> <button type="button" class="btn btn-danger remove-sell-row">-</button></td>';
            tr += '</tr>'; 
            $('#sellBody').append(tr);
            $('.select2').select2();
            i++;
            }
        }); 
});
$(document).on('click','.remove-sell-row', function(){
                 $(this).parent().parent().remove();
        });



        $('tbody').on('change', '.selectSellItem', function() { 
        var itemId = $(this).val();
        var dataId = $(this).attr('data-id');
        var colorId  = $('#color'+dataId).val();
        var sizeId   = $(this).val(); 
        // console.log('hi');
        //alert ('ok');
        //alert (itemId);
        $.ajax({
                type: 'GET',
                url : "{{ url('sell-info-by-item-id') }}",
                data: {id:itemId , color: colorId, size: sizeId},
                dataType: 'json',
                success: function(res){
                                // console.log(res);
                        var colorSelect = $('#color'+dataId);
                                colorSelect.empty();
                        var colorOption = ''; 
                            colorOption += '<option value="" selected disabled>Select</option>';
                                $.each(res.colors, function(key, value){
                                colorOption += '<option value="'+value.id+'">'+value.title+'</option>'; 
                                });
                        colorSelect.append(colorOption);

                        var sizeSelect = $('#size'+dataId);
                                sizeSelect.empty();
                        var sizeOption = '';
                            sizeOption += '<option value="" selected disabled>Select</option>';
                        $.each(res.sizes, function(key, value){
                                sizeOption += '<option value="'+value.id+'">'+value.title+'</option>'; 
                                });
                                sizeSelect.append(sizeOption);

                        var price = $('#price'+dataId);
                                price.val(res.price);

                        var qty = $('#qty'+dataId); 
                        //      qty.val(res.qty);
                             qty.val(0);

                        var total = $('#total'+dataId);
                        //     total.val(res.price*res.qty);
                            total.val(0);
                }
        });
});

$(document).on('change','.selectSellSize', function(){
        var dataId   = $(this).attr('data-id');
        var sizeId   = $(this).val();
        var itemId   = $('#selectSellItem'+dataId).val();
        var colorId  = $('#color'+dataId).val();
        //  alert(colorId);
        $.ajax({
                type: 'GET',
                url : "{{ url('size-color-wais-stock') }}",
                data: {size:sizeId, color:colorId, item:itemId},
                dataType: 'json',
                success: function(res){
                        //  console.log(res);
                         var qtySelect = $('#qty'+dataId);
                         qtySelect.val(res.item.qty);

                         var total = $('#total'+dataId);
                            total.val(res.price*res.item.qty);
                }
        });
          
});


$(document).on('change','.selectSellColor', function(){
        var dataId   = $(this).attr('data-id');
        var colorId   = $(this).val();
        var itemId   = $('#selectSellItem'+dataId).val();
        var sizeId  = $('#size'+dataId).val();
        //  alert(colorId);
        $.ajax({
                type: 'GET',
                url : "{{ url('size-color-wais-stock') }}",
                data: {size:sizeId, color:colorId, item:itemId},
                dataType: 'json',
                success: function(res){
                        //  console.log(res);
                         var qtySelect = $('#qty'+dataId);
                         qtySelect.val(res.item.qty);

                         var total = $('#total'+dataId);
                            total.val(res.price*res.item.qty);
                }
        });
          
});

$(document).on('change','.productBuyViaPay', function(){
        
        $.ajax({
                type: 'GET',
                url : "{{ url('accounts-for-product-buy-page') }}",
                data: '',
                dataType: 'json',
                success: function(res){
                        console.log(res);
                        var tr = '';
                        var tr = '<tr class="accountTr">';
                        tr +='<th>Accounts:</th>';
                        tr += '<td>';
                        tr +='<select name="account" class="select2 form-control" id="">';
                        tr +='<option value="0">Cash</option>';   
                              $.each(res.accounts, function(key,value){
                                tr +='<option value="'+value.id+'">'+value.title+'</option>';  
                              })   
                                
                        tr +='</select>';
                        tr +='</td>';
                        tr +='</tr>';
                        $('#productBasicinfoTable').append(tr);   
                }
        });

       
});

$(document).on('change','.productBuyViaDue', function(){
        $('.accountTr').remove();
});
</script>