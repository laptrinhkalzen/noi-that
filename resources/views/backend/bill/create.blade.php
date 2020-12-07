@extends('backend.layouts.master1')
@section('content1')   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>    
<body>


<div class="content">

    <form action="{!!route('admin.bill.store',['stock_id' => 1])!!}" method="POST" enctype="multipart/form-data">

                     <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div id="printSection" class="modal-body">
                               <p >123</p>
                            </div>
                            <div class="modal-footer">
                              <button onclick="window.print()" type="submit" class="btn btn-info">Lưu và in</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Lập hóa đơn</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
               <!--  <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item">
                 
                       <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Chọn kho
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                             @foreach($stocks as $stock)
                                <li style="margin-left: 10px;"><a name="{{$stock_id}}" value="{{$stock->id}}" href="{{route('admin.export.create',['id' => $stock->id])}}">{{$stock->name}}</a></li>
                             @endforeach
                          </ul>
                        </div>
                    </li>
                </ul> -->
                    
             <script type="text/javascript">
                           $(document).ready(function () {
                                $('#apply_coupon').click(function(){
                            
                                 
                                      var coupon_code=$('#coupon').val();
                                    //alert(coupon_code);
                                    $.ajax({
                                          url:'{{route("api.change_status")}}',
                                          data:{coupon_code:coupon_code},
                                          success:function(res){
                                              var after_apply=$('#result').val()-res.coupon_code;
                                              $('#total_price').val(after_apply);
                                          }
                                    });
                              });
                              
                              $('body').delegate('input[name="quantity[]"],#discount,#type,.price,.xoa','change',function (){

                           var price=$(this).parent('.form-group').parent('.form-row').find('.price').val();
                                 var quantity=$(this).parent('.form-group').parent('.form-row').find('input[name="quantity[]"]').val();
                                 if(quantity<1){
                                    alert('Vui lòng nhập số lượng lớn hơn 1');
                                 }
                                 else{
                                 var disc = $('#discount').val();
                                 // var tien = $('#tien').val();
                                 // var phantram = $('#phantram').val();
                                 var type = $('#type').find(":selected").data('type');
                                 $(this).parent('.form-group').parent('.form-row').find('.qty1').val(price*quantity);
                                 }
                                 var sum=0;
                                    $(".qty1").each(function(){
                                        if($(this).val() !== "")
                                          sum += parseInt($(this).val(), 10);
                                    });
                                     $("#result_total").val(sum);
                                    if(type==1){
                                     if(sum>disc){   
                                    $("#result").val(sum-disc);
                                    }
                                    else{
                                        alert('Vui lòng nhập chiết khấu nhỏ hơn tổng giá');
                                    }
                                    }
                                     else{
                                        $("#result").val(sum-(sum/100*disc));
                                     }

                                     var coupon_code=$('#coupon').val();
                                      console.log(coupon_code);
                                     if(coupon_code!=''){
                                 $.ajax({
                                          url:'{{route("api.change_status")}}',
                                          data:{coupon_code:coupon_code},
                                          success:function(res){
                                              var after_apply=$('#result').val()-res.coupon_code;
                                              $('#total_price').val(after_apply);
                                          }
                                    });
                                 }
                              });
                            });


                         </script> 
                         
                

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <fieldset>
                                   <table class="table ">
                                      <thead>
                                        <tr>
                                          <th style="width: 24%;">Sản phẩm</th>
                                          <th style="width: 17%;">Tồn kho</th>
                                          <th style="width: 17%;" >Giá</th>
                                          <th scope="col">Số lượng</th>
                                          <th scope="col">Thành tiền</th>
                                          <th scope="col"></th>
                                        </tr>
                                      </thead>
                                     

                                  
                                 </table>
                                    <div class="form-row" style="margin-left: 0px; margin-top: 10px;">

                                   <div class="form-group col-md-3" id="vehicle-type">
                                      <select class="select2 form-control" name="product[]">
                                        <option value="">------Chọn------</option> 
                                           @foreach($products as $product)
                                              <option data-quantity1="{{$product->stock_product_quantity}}" data-price1="{{$product->sell_price}}" value="{{$product->id}}">{{$product->title}}</option>
                                            @endforeach
                                      </select>
                                  </div> 
                                     <div class="form-group col-md-2" >
                                       <input  readonly  type="number"  class="form-control quantity-input" required="">
                                     </div>

                                     <div class="form-group col-md-2" >
                                     <input  type="text" readonly  name="price[]" min="1" class="form-control price price-input" required="">
                                     </div>
                                     <div class="form-group col-md-2" >
                                       <input id="quantity"  name="quantity[]" type="number"  min="1" class="form-control " required="">
                                     </div>

                                    <div class="form-group col-md-2" >
                               
                                       <input id="total" name="sub_total[]" class="form-control qty1" value="" readonly="true">
                                    </div>
                                    
                                    </div>
                                      <div class="input_fields_wrap">
                                    </div>
                               

                                </fieldset>
                            </div>
                           

                                <script>
                                $(document).ready(function() {
                                var max_fields = 15; //maximum input boxes allowed
                                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                                var add_button = $(".add_field_button"); //Add button ID
                                var x = 1; //initlal text box count
                                $(add_button).click(function(e){ //on add input button click
                                e.preventDefault();
                                if(x < max_fields){ //max input box allowed
                                x++; //text box increment
                                $(wrapper).append('  <div class="form-row" style="margin-left: 0px; margin-top: 10px;"><div class="form-group col-md-3" id="vehicle-type"><select class="select2 form-control" name="product[]"><option>------Chọn------</option> @foreach($products as $product)<option data-quantity1="{{$product->stock_product_quantity}}" data-price1="{{$product->sell_price}}" value="{{$product->id}}">{{$product->title}}</option>@endforeach</select></div> <div class="form-group col-md-2" ><input  readonly  type="number"  class="form-control quantity-input" required=""></div><div class="form-group col-md-2" ><input  type="text" value="" name="price[]" min="1" readonly class="form-control price price-input" required=""></div><div class="form-group col-md-2" ><input id="quantity"  name="quantity[]" type="number"  min="1" class="form-control " required=""></div><div class="form-group col-md-2" ><input id="total" name="sub_total[]" class="form-control qty1" value="" readonly="true"></div><div style="cursor:pointer; background-color:red; height:35px;" class="remove_field btn btn-info xoa">Xóa</div></div>'); 
                                     $('.select2').select2({
     //configuration
                                     });
                                }
                                });
                             
                                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                                e.preventDefault(); $(this).parent('div').remove(); x--;
                                })
                                });
                              

                               
                    
                </script>
                <script type="text/javascript">
                     $(document).ready(function() {
                              $('.select2').select2();
                              });


                </script>

                            <div class="col-md-4">
                                 <h5 style="text-decoration:underline;">Thông tin đơn hàng</h5>
                              <!--   <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Nhà cung cấp</label>
                                    <div class="col-md-7">
                                         <select class="js-example-basic-single" name="supplier">
                                            @foreach($suppliers as $supplier)
                                              <option  value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                               <!--  <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Ngày nhập</label>
                                    <div class="col-md-7">
                                        <input type="date" name="date_import" class="form-control " >
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Nhân viên bán</label>
                                    <div class="col-md-7">
                                         <select class="select2 form-control" name="user_id">
                                        <option value="">------Chọn------</option> 
                                           @foreach($users as $user)
                                              <option  value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Khách hàng </label>
                                    <div class="col-md-7">
                                         <select class="select2 form-control" name="customer_id">
                                        <option value="">------Chọn------</option> 
                                           @foreach($customers as $customer)
                                              <option value="{{$customer->id}}">{{$customer->full_name}} ({{$customer->id}})</option>
                                            @endforeach
                                      </select>
                                    </div>
                                </div>
                         <!--      <div class="form-group row">
        <label class="col-form-label col-md-4 text-left">Khách hàng </label>

        <div class="col-md-7">
          <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#citizen">Chọn</button>
          <div id="citizen" class="collapse">
         
                                    
                                         <select class="select2 form-control" name="customer_id">
                                        <option value="">------Chọn------</option> 
                                           @foreach($customers as $customer)
                                              <option value="{{$customer->id}}">{{$customer->full_name}} ({{$customer->id}})</option>
                                            @endforeach
                                      </select>
                                  
        </div>
      </div>
      <div class="col-md-9">
        <p style="margin-left: 320px;">or</p>
      </div>
  
        <div style="margin-left:181px;" class="col-md-7">
          <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#organisation">Thêm mới
          </button>
          <div id="organisation" class="collapse">
         
                                
                                         <select class="select2 form-control" name="customer_id">
                                        <option value="">------Chọn------</option> 
                                           @foreach($customers as $customer)
                                              <option value="{{$customer->id}}">{{$customer->full_name}} ({{$customer->id}})</option>
                                            @endforeach
                                      </select>
                                 
          </div>
        </div>
     
        
      </div>  -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Ghi chú </label>
                                    <div class="col-md-7">
                                         <textarea class="form-control" name="note" rows="4" id="comment"></textarea>
                                    </div>
                                </div>
                                
                              
                                <h5 style="text-decoration:underline;">Thông tin thanh toán</h5>
                                   
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Hình thức thanh toán </label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="payment_type" id="sel1">
                                            <option value="tienmat">Tiền mặt</option>
                                            <option value="chuyenkhoan">Chuyển khoản</option>
                                            <option value="the">Thẻ</option>  
                                          </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Chiết khấu </label>

                                    <div class="row" style="margin-left: 9px;">
                                        <select name="discount_type" class="form-control col-md-3" id="type">
                                            <option value="1" data-type="1">$</option>
                                            <option value="2" data-type="2">%</option>  
                                          </select>
                                        <input  type="number" id="discount" name="discount" class="form-control col-md-9">
                                        
                                    </div>
                                </div> 
                                

                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Mã giảm giá </label>
                                    
                                    <div class="col-md-6 ">
                                        <input  type="text" id="coupon" name="coupon" class="form-control">
                                         <input id="apply_coupon" type="button" value="check"  class="btn btn-success">
                                    </div>
                                </div> 
                               
                            

                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Tổng</label>
                                    <div class="col-md-7">
                                        <input id="result_total" name="total" class="form-control" readonly="true">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Cần thanh toán</label>
                                    <div class="col-md-7">
                                        <input id="result" name="total_payment" class="form-control" readonly="true">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">sau giảm giá</label>
                                    <div class="col-md-7">
                                        <input id="total_price" name="" class="form-control" readonly="true">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Đã thanh toán</label>
                                    <div class="col-md-7">
                                        <input  type="text" name="customer_payment" class="form-control">
                                    </div>
                                </div>  
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Hẹn thanh toán </label>
                                    <div class="col-md-7">
                                        <input type="date" name="payment_appointment" class="form-control " >
                                    </div>
                                </div> 
                              
                            </div>

                           
                        </div>
                    </div>

      

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a type="button" href="{{route('admin.import.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class=""></i></button>
                             <button style="background-color: MediumSeaGreen;" type="submit" name="print1" value="1" class="btn btn-primary legitRipple">Lưu lại và in <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
                           
  
                            $(document).ready(function () {
                               
                              $('body').delegate('#vehicle-type','change',function (){
                                 $(this).parents('.form-row').find('.price-input').val(
                                  $(this).find('.select2').find(":selected").data("price1")
                                );
                                 $(this).parents('.form-row').find('.quantity-input')
                                .val(
                                  $(this).find(":selected").data("quantity1")
                                );
                                  
                              });
                          
                            });
                            // $(document).ready(function(){
                            //     $(".btn").click(function(){
                            //       $('.collapse.in').collapse('hide');
                            //     });
                            //   });
</script>
<script type="text/javascript">

    
  
</script>

</body>



@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tagsinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tokenfield.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/ui/prism.min.js') !!}"></script>

<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/anytime.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.date.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.time.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/legacy.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/notifications/jgrowl.min.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop
