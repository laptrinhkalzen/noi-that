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
                <h2 style="text-align: center;">Phiếu kiểm kho</h2>
                
                    <div class="row">
                      <div class="col-xs-6">
                        
                        <address style="margin-left: 20px;">
                        
                          ID phiếu kiểm kho: {{$inventorys->inventory_id}}<br>
                          Thời gian lập: {{$inventorys->created_at}}<br>
                          Người lập: {{$inventorys->user_name}}<br>
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
                                  <td class="text-center"><strong>Tồn kho</strong></td>
                                  <td class="text-center"><strong>Thực kiểm</strong></td>
                                  <td class="text-right"><strong>Chênh lệch</strong></td>
                                </tr>
                                            
                            </thead>
                            <tbody>
                                @foreach($print_inventorys as $key => $inventory)

                              <!-- foreach ($order->lineItems as $line) or some such thing here -->
                              <tr>
                                <td>{{$inventory->title}}</td>
                                <td class="text-center">{{$inventory->exist}}</td>
                                <td class="text-center">{{$inventory->real}}</td>
                                <td class="text-right">{{$inventory->difference}} </td>
                              </tr>

                                            
                              @endforeach
                              <tr>
                                <td class="thick-line text-center"><strong>Tổng cộng</strong></td>
                                <td class="thick-line text-center"><strong>{{$total_exist}}</strong></td>
                                <td class="thick-line text-center"><strong>{{$total_real}}</strong></td>
                                <td class="thick-line text-right"><strong> {{$total_difference}}</strong> </td>
                              </tr>

                              

                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            <div style="display: flex;text-align: center;margin-top: 25px;">
                    <div style="margin-left: 250px;">
                        <strong>Nhân viên kho</strong><br>
                        (Ký, họ tên)
                    </div>
                    <div style="margin-left: 300px;">
                        <strong>Người lập phiếu</strong><br>
                        (Ký, họ tên)
                    </div>
                </div>

            <div   class="hide-from-printer" style="text-align: center;margin-top: 100px;"><a href="{{route('admin.inventory.index')}}"  onclick="window.print()" type="submit" style=" width: 70px;" class="btn btn-info">In</a></div>
                                        




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