@extends('backend.layouts.master1')
@section('content1') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
          
              <div class="container">
                <h2 style="text-align: center;">Hóa đơn</h2>
                
                    <div class="row">
                      <div class="col-xs-6">
                        
                        <address>
                        
                          ID: {{$bills->bill_id}}<br>
                          Khách hàng: {{$bills->customer_name}}<br>
                          Thời gian lập: {{$bills->created_at}}<br>
                          Người lập:<br>
                        </address>
                        
                      </div>
                      <div class="col-xs-6 text-right">
                        
                      </div>
                    </div>
                    
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title"><strong>Danh sách sản phẩm</strong></h3>
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-condensed">
                            <thead>
                                <tr>
                                  <td><strong>Sản phẩm</strong></td>
                                  <td class="text-center"><strong>Giá</strong></td>
                                  <td class="text-center"><strong>Số lượng</strong></td>
                                  <td class="text-right"><strong>Tổng tiền</strong></td>
                                </tr>
                                            
                            </thead>
                            <tbody>
                                @foreach($print_products as $key => $product)

                              <!-- foreach ($order->lineItems as $line) or some such thing here -->
                              <tr>
                                <td>{{$product->title}}</td>
                                <td class="text-center">{{$product->price}}</td>
                                <td class="text-center">{{$product->quantity}}</td>
                                <td class="text-right">{{$product->sub_total}} đ</td>
                              </tr>

                                            
                              @endforeach
                              <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"></td>
                                <td class="thick-line text-right"><strong>{{$total}} đ</strong> </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            <div style="display: flex;">
                    <div style="margin-left: 250px;">
                        <strong>Người lập phiếu</strong><br>
                        (Ký, họ tên)
                    </div>
                    <div style="margin-left: 300px;">
                        <strong>Người lập phiếu</strong><br>
                        (Ký, họ tên)
                    </div>
                </div>

            <div  class="hide-from-printer" style="text-align: center;"><button  onclick="window.print()" type="submit" class="btn btn-info">Lưu và in</button></div>
                                        




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
