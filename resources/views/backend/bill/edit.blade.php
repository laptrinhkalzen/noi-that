@extends('backend.layouts.master1')
@section('content1')   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>    
<body>


<div class="content">
    <form action="{!!route('admin.bill.update',['id' => $bill->bill_id,'stock_id'=>$bill->stock_id])!!}" method="POST" enctype="multipart/form-data">
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
             <script type="text/javascript">
                           $(document).ready(function () {
                               
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
                                  @foreach($bill_products as $product)
                                    <div class="form-row" style="margin-left: 0px; margin-top: 10px;">
                                  
                                   <div class="form-group col-md-3" id="vehicle-type">
                                       <input  readonly  type="text"  class="form-control" value="{{$product->title}}" required="">
                                       <input   type="hidden"  class="form-control" name="product[]" value="{{$product->id}}" required="">
                                  </div> 
                                     <div class="form-group col-md-2" >
                                      @foreach($stock_products as $stock_product)
                                      @if($stock_product->product_id==$product->product_id)
                                       <input  readonly value="{{$stock_product->stock_product_quantity}}" type="number"  class="form-control quantity-input" required="">
                                       @endif
                                       @endforeach
                                     </div>

                                     <div class="form-group col-md-2" >
                                     <input  type="text"  value="{{$product->price}}" name="price[]" min="1" class="form-control price price-input" required="">
                                     </div>
                                     <div class="form-group col-md-2" >
                                       <input id="quantity" value="{{$product->quantity}}" name="quantity[]" type="number"  min="1" class="form-control " required="">
                                     </div>

                                    <div class="form-group col-md-2" >
                               
                                       <input id="total" value="{{$product->sub_total}}" name="sub_total[]" class="form-control qty1" value="" readonly="true">
                                    </div>
                                  
                                    </div>
                                    @endforeach
                                      <button class="add_field_button btn btn-info active" style="height: 35px;">Thêm</button>
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
                            
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Nhân viên bán</label>
                                    <div class="col-md-7">
                                         <select class="select2 form-control" name="user_id">
                                        <option value="">------Chọn------</option> 
                                           @foreach($users as $user)
                                           @if($user->id==$bill->user_id)
                                              <option selected value="{{$user->id}}">{{$user->full_name}}</option>
                                            @else
                                              <option  value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endif  
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
                                              @if($customer->id==$bill->customer_id)
                                              <option selected value="{{$customer->id}}">{{$customer->full_name}} ({{$customer->id}})</option>
                                              @else
                                              <option value="{{$customer->id}}">{{$customer->full_name}} ({{$customer->id}})</option>
                                              @endif
                                            @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Ghi chú </label>
                                    <div class="col-md-7">
                                         <textarea class="form-control" name="note" rows="4" id="comment">{{$bill->note}}</textarea>
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

                                    <div class="col-md-7">
                                        <input  type="text" id="discount" name="coupon" value="{{$bill->coupon}}" class="form-control">
                                    </div>
                                </div> 
                               
                            

                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Tổng</label>
                                    <div class="col-md-7">
                                        <input id="result_total" name="total" value="{{$bill->total}}" class="form-control" readonly="true">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Cần thanh toán</label>
                                    <div class="col-md-7">
                                        <input id="result" name="total_payment" value="{{$bill->total_payment}}" class="form-control" readonly="true">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Đã thanh toán</label>
                                    <div class="col-md-7">
                                        <input  type="text" name="customer_payment" value="{{$bill->customer_payment}}" class="form-control">
                                    </div>
                                </div>  
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Hẹn thanh toán </label>
                                    <div class="col-md-7">
                                        <input type="date" name="payment_appointment" value="{{$bill->payment_appointment}}" class="form-control " >
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
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                            <a  class="btn btn-light legitRipple" data-toggle="modal" data-target="#myModal">Lưu và in <i class="icon-arrow-right14 position-right"></i></a>
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
