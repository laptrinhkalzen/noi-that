@extends('backend.layouts.master1')
@section('content1')   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>    
<body>


<div class="content">
    <form action="{!!route('admin.inventory.store')!!}" method="POST" enctype="multipart/form-data">
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
              
                    
             <script src="jquery-3.5.1.min.js"></script>
             <script type="text/javascript">
                           $(document).ready(function () {
                               
                              $('body').delegate('input[name="real[]"],.quantity-input','change',function (){
                                var quantity1=$(this).parents('.form-row').find('.quantity-input').val();
                                 var quantity=$(this).parent('.form-group').parent('.form-row').find('input[name="real[]"]').val();
                                 $(this).parent('.form-group').parent('.form-row').find('.qty1').val(quantity1-quantity);
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
                                          <th style="width: 17%;" >Thực kiểm</th>
                                          <th scope="col">Chênh lệch</th>
                                          <th scope="col"></th>
                                        </tr>
                                      </thead>
                                     

                                  
                                 </table>
                                    <div class="form-row" style="margin-left: 0px; margin-top: 10px;">

                                   <div class="form-group col-md-3" id="vehicle-type">
                                      <select class="select2 form-control" name="product[]">
                                        <option value="">------Chọn------</option> 
                                           @foreach($products as $product)
                                              <option value="{{$product->id}}" data-quantity1="{{$product->stock_product_quantity}}" >{{$product->title}}</option>
                                            @endforeach
                                      </select>
                                  </div> 
                                     <div class="form-group col-md-2" >
                                       <input  readonly  type="number" name="exist[]"  class="form-control quantity-input" required="">
                                     </div>

                                    
                                     <div class="form-group col-md-2" >
                                       <input id="quantity"  name="real[]" type="number"  min="1" class="form-control " required="">
                                     </div>

                                    
                                    <div class="form-group col-md-2" >
                               
                                       <input id="total" name="difference[]" class="form-control qty1" value="" readonly="true">
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
                                $(wrapper).append('  <div class="form-row" style="margin-left: 0px; margin-top: 10px;"><div class="form-group col-md-3" id="vehicle-type"><select class="select2 form-control" name="product[]"><option>------Chọn------</option> @foreach($products as $product)<option data-quantity1="{{$product->stock_product_quantity}}" value="{{$product->id}}">{{$product->title}}</option>@endforeach</select></div> <div class="form-group col-md-2" ><input  readonly  type="number" name="exist[]" class="form-control quantity-input" required=""></div><div class="form-group col-md-2" ><input id="quantity"  name="real[]" type="number"  min="1" class="form-control " required=""></div><div class="form-group col-md-2" ><input id="total"  name="difference[]" class="form-control qty1" value="" readonly="true"></div><div style="cursor:pointer; background-color:red; height:35px;" class="remove_field btn btn-info xoa">Xóa</div></div>'); 
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
                                    <label class="col-form-label col-md-4 text-left">Người kiếm</label>
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
                                    <label class="col-form-label col-md-4 text-left">Ghi chú </label>
                                    <div class="col-md-7">
                                         <textarea class="form-control" name="note" rows="4" id="comment"></textarea>
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
                                 $(this).parents('.form-row').find('.quantity-input').val(
                                  $(this).find('.select2').find(":selected").data("quantity1")
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
