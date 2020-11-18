
@extends('backend.layouts.master')
@section('content')
<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Cập nhật</h5>
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
                    <form action="{!!route('admin.marketing.update', $record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Họ tên <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="full_name" value="{!!old('full_name')?:$record->full_name!!}" required="">
                                    {!! $errors->first('full_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Url:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="alias" value="{!!old('alias')?:$record->alias!!}">
                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" value="{!!old('email')?:$record->email!!}" required="">
                                    {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Số điện thoại <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobile" value="{!!old('mobile')?:$record->mobile!!}" required="">
                                    {!! $errors->first('mobile', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Địa chỉ</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" value="{!!old('address')?:$record->address!!}">
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tên công ty</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="company_name" value="{!!old('company_name')?:$record->company_name!!}">
                                    {!! $errors->first('company_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Quốc gia</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" data-placeholder="Chọn quốc gia" data-fouc name="country_id">
                                        {!!$country_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tỉnh, thành phố</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" data-placeholder="Chọn tỉnh thành phố" data-fouc name="province_id">
                                        {!!$province_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Quận, huyện</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" data-placeholder="Chọn quận huyện" data-fouc name="district_id">
                                        {!!$district_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Cấp bậc</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" data-placeholder="Chọn cấp bậc" data-fouc name="rank_id">
                                        {!!$rank_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check col-md-4 form-check-right">
                                    <label class="form-check-label float-right">
                                        Kích hoạt
                                        <div class=""><span><input type="checkbox" class="form-check-input-styled" {{($record->status == 1)?'checked':''}} name="status" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </div>

                        </fieldset>
                        <div class="text-right">
                            <button type="cancel" class="btn btn-secondary legitRipple">Hủy</button>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Đơn hàng</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="get" action="{!!route('admin.marketing.edit',$record->id)!!}">
                <div class="row" style="margin-top:10px">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar5"></i></span>
                            </span>
                            <input type="text" class="form-control pickadate" name="start_date" @if(isset($search['start_date_submit'])) data-value="{{date( "Y/m/d", strtotime($search['start_date_submit']))}}" @endif  value="@if(isset($search['start_date_submit'])) {{date( "d/m/Y", strtotime($search['start_date_submit']))}} @endif" placeholder="Chọn ngày bắt đầu">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar5"></i></span>
                            </span>
                            <input type="text" class="form-control pickadate" name="end_date" @if(isset($search['end_date_submit'])) data-value="{{date( "Y/m/d", strtotime($search['end_date_submit']))}}" @endif value="@if(isset($search['end_date_submit'])) {{date( "d/m/Y", strtotime($search['end_date_submit']))}} @endif" placeholder="Chọn ngày kết thúc">
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <button type="submit" class="btn btn-info">Tìm</button>
                    </div>
                </div>
            </form>
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Số đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Hoa hồng</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key =>$order)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$order->id}}</td>
                        <td>{{number_format($order->total)}} đ</td>
                        <td>@if ($order->discount_percent) {{number_format($order->discount_percent * $order->total/100)}} đ @endif </td>
                        <td>{{date('d/m/Y' , strtotime($order->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
<script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.date.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/picker_date.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop
