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
                <h2 style="text-align: center;">Phiếu nhập</h2>
                
                    <div class="row">
                      <div class="col-xs-6">
                      <div style="display: flex;">
                        

                        <address style="margin-left: 50px;">
                          ID phiếu nhập: {{$imports->import_id}}<br>
                          Thời gian lập: {{$imports->created_at}}<br>
                          Người lập:<br>
                        </address>

                        <address style="margin-left: 400px;">
                          Cửa hàng: {{$stocks->name}}<br>
                      
                          Nhà cung cấp: {{$suppliers->supplier_name}}<br>
                          Ngày hẹn thanh toán: {{$imports->payment_day}}<br>
                        </address>
                      </div>
                      </div>
                      <div class="col-xs-6 text-right">
                        
                      </div>
                    </div>
                    
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title"><strong></strong></h3>
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-condensed">
                            <thead>
                                <tr>
                                  <td><strong>STT</strong></td>
                                  <td class="text-center"><strong>Mã sản phẩm</strong></td>
                                  <td class="text-center"><strong>Tên sản phẩm</strong></td>
                                  <td class="text-center"><strong>Số lượng</strong></td>
                                  <td class="text-center"><strong>Giá</strong></td>
                                  <td class="text-right"><strong>Thành tiền</strong></td>
                                </tr>
                                            
                            </thead>
                            <tbody>
                                @foreach($print_imports as $key => $import)

                              <!-- foreach ($order->lineItems as $line) or some such thing here -->
                              <tr>
                                <td>{{$key+1}}</td>
                                <td class="text-center">{{$import->product_id}}</td>
                                <td class="text-center">{{$import->title}} </td>
                                <td class="text-center">{{$import->quantity}}</td>
                                <td class="text-center">{{$import->import_price}}</td>
                                <td class="text-right">{{$import->sub_total}} đ</td>
                              </tr>

                                            
                              @endforeach
                            <tr>
                                
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Tổng cộng</strong></td>
                                <td class="thick-line text-right"><strong>{{$total}} đ</strong> </td>
                              </tr>

                              <tr>
                                
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Chiết khấu</strong></td>
                                @if($imports->discount_type==1)
                                <td class="thick-line text-right"><strong>{{$imports->discount}} đ</strong> </td>
                                @else
                                <td class="thick-line text-right"><strong>{{$imports->discount}} %</strong> </td>
                                @endif
                              </tr>

                              <tr>
                                
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Cần thanh toán</strong></td>
                                <td class="thick-line text-right"><strong>{{$imports->total_payment}} đ</strong> </td>
                              </tr>

                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            <div style="display: flex;text-align: center;">
                    <div style="margin-left: 250px;">
                        <strong>Nhân viên kho</strong><br>
                        (Ký, họ tên)
                    </div>
                    <div style="margin-left: 300px;">
                        <strong>Người lập phiếu</strong><br>
                        (Ký, họ tên)
                    </div>
                </div>

             <div   class="hide-from-printer" style="text-align: center;margin-top: 100px;"><a href="{{route('admin.import.index')}}" onclick="window.print()" type="submit" style=" width: 70px;" class="btn btn-info">In</a></div>
                                        




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

