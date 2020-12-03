
@extends('backend.layouts.master')
@section('content')
<div class="content">  
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Tạo mới</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="{!!route('admin.coupon.store')!!}" class="form-validate-jquery" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            
                       
                                    
                         <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tên mã <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="coupon_name"  required="">
                                    {!! $errors->first('coupon_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Mã code <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="coupon_code"  required="">
                                    {!! $errors->first('coupon_code', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-form-label col-md-3 text-right">Số lượng </label>
                                <div class="col-md-2">
                                    <input type="text" name="coupon_number" class="form-control touchspin text-center" value="0">
                                     {!! $errors->first('coupon_nunmber', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Loại giảm</label>
                                <div class="col-md-9">
                                     <select name="coupon_type" class="form-control ">
                                             <option value="0">----Chọn-----</option>
                                            <option value="1">Giảm theo phần trăm</option>
                                            <option value="2">Giảm theo tiền</option>
                                            
                                 </select>
                                  {!! $errors->first('coupon_type', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                               <div class="form-group row">
                                <label class="col-form-label col-md-3 text-right">Giá trị giảm </label>
                                <div class="col-md-2">
                                    <input type="text" name="coupon_value" class="form-control touchspin text-center" value="0">
                                     {!! $errors->first('coupon_value', '<span class="text-danger">:message</span>') !!}
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-form-label col-md-3 text-right">Điều kiện giảm </label>
                                <div class="col-md-2">
                                    <input type="text" name="coupon_condition" class="form-control touchspin text-center" value="0">
                                     {!! $errors->first('coupon_condition', '<span class="text-danger">:message</span>') !!}
                                </div>
                              </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Hạn dùng <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="coupon_end"  required="">
                                    {!! $errors->first('coupon_end', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            
                             <div class="form-group row" style="float: right;"> 
                                    <div class="form-check col-md-6 form-check-right">
                                        <label class="form-check-label float-right">
                                            Hiển thị
                                            <input type="checkbox" class="form-check-input-styled" name="coupon_status" data-fouc="">
                                        </label>
                                    </div>
                                </div>

                       
                       

                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.coupon.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>


                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>

<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
@stop