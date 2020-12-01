@extends('backend.layouts.master')
@section('content')       
<body>

<div class="content">
    <form action="{!!route('admin.import.store')!!}" method="POST" enctype="multipart/form-data">
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
                <h6 class="card-title">Tạo mới phiếu nhập</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab">
                                   <select class="js-example-basic-single" name="stock">
                                            @foreach($stocks as $stock)
                                              <option  value="{{$stock->id}}">{{$stock->name}}</option>
                                            @endforeach
                                        </select></a></li>
                   <!--  <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-stack2 mr-2"></i> Thuộc tính sản phẩm</a></li>
                    <li class="nav-item"><a href="#left-icon-tab3" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thẻ meta</a></li> -->

                </ul>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="jquery-3.5.1.min.js"></script>
             <script type="text/javascript">
                           $(document).ready(function () {
                               
                              $('body').delegate('input[name="quantity[]"],#discount,#type,.price','change',function (){
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
                                          <th scope="col">Sản phẩm</th>
                                          <th scope="col">Giá vốn</th>
                                          <th scope="col">Số lượng</th>
                                          <th scope="col">Thành tiền</th>
                                       
                                        </tr>
                                      </thead>
                                     

                              
                                 </table>
                                    <div class="form-row" style="margin-left: 0px; margin-top: 10px;">
                                        
                                            
                                    <div class="form-group col-md-3" id="vehicle-type">
                                      <select class="select2 form-control" name="product[]">
                                        <option>------Chọn------</option> 
                                           @foreach($products as $product)
                                              <option  data-price1="{{$product->price}}" value="{{$product->id}}">{{$product->title}}</option>
                                            @endforeach
                                      </select>
                                  </div>

                                     
                                     <div class="form-group col-md-2" >
                                     <input  type="text" value="" name="import_price[]" min="1" class="form-control price-input price" required="">
                                     </div>
                                     <div class="form-group col-md-2">
                              
                                       <input id="quantity"  name="quantity[]" type="number" value="1" min="1" class="form-control" required="">
                                     </div>

                                    <div class="form-group col-md-2" >
                               
                                       <input id="total" name="sub_total[]" class="form-control qty1" value="" readonly="true">
                                    </div>
                                    <button class="add_field_button btn btn-info active" style="height: 35px;">Thêm</button>
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
                                $(wrapper).append('<div class="form-row" style="margin-left: 0px; margin-top: 10px;"><div class="form-group col-md-3" id="vehicle-type" ><select class="select2 form-control js-example-basic-single" name="product[]"><option>------Chọn------</option> @foreach($products as $product)<option  data-price1="{{$product->price}}" value="{{$product->id}}">{{$product->title}}</option>@endforeach</select></div><div class="form-group col-md-2" ><input  type="text" value="" name="import_price[]" min="1" class="form-control price price-input" required=""></div><div class="form-group col-md-2"><input id="quantity"  name="quantity[]" type="number" value="1" min="1" class="form-control" required=""></div><div class="form-group col-md-2" ><input id="total" name="sub_total[]" class="form-control qty1" value="" readonly="true"></div><div style="cursor:pointer; background-color:red; height:35px;" class="remove_field btn btn-info">Xóa</div></div>'); 
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
                                 <h5 style="text-decoration:underline;">Thông tin nhập kho</h5>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Nhà cung cấp</label>
                                    <div class="col-md-7">
                                         <select class="select2 form-control" name="supplier">
                                            @foreach($suppliers as $supplier)
                                              <option  value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               <!--  <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Ngày nhập</label>
                                    <div class="col-md-7">
                                        <input type="date" name="date_import" class="form-control " >
                                    </div>
                                </div> -->
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
                                    <label class="col-form-label col-md-4 text-left">Đã thanh toán</label>
                                    <div class="col-md-7">
                                        <input  type="text" name="paid" class="form-control">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Còn nợ </label>
                                    <div class="col-md-7">
                                        <input type="text" name="still_owe" class="form-control" >
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Hẹn thanh toán </label>
                                    <div class="col-md-7">
                                        <input type="date" name="payment_day" class="form-control " >
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
</body>
<script type="text/javascript">
  

  
                            $(document).ready(function () {
                              $('body').delegate('#vehicle-type','change',function (){
                                 $(this).parents('.form-row').find('.price-input').val(
                                  $(this).find('.select2').find(":selected").data("price1")
                                );  
                              });
                            });
</script>

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
