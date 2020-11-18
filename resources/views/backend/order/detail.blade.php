
@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Đơn hàng</h5>
                        <div class="btn-group justify-content-center">
                            <a href="#" class="btn bg-indigo-400 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tác vụ</a>
                            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -183px, 0px);">
                                <a href="javascript:void(0)" class="dropdown-item" data-order_id="{{$record->id}}" data-action="change-status" data-status="1" class="status1">Đang xử lý</a>
                                <a href="javascript:void(0)" class="dropdown-item" data-order_id="{{$record->id}}" data-action="change-status" data-status="2" class="status2">Xác nhận</a>
                                <a href="javascript:void(0)" class="dropdown-item" data-order_id="{{$record->id}}" data-action="change-status" data-status="3" class="status3">Từ chối</a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <h6 class="mb-0">Ngày đặt:</h6>
                            </td>
                            <td><span>{{$record->created_at()}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Trạng thái:</h6>
                            </td>
                            <td>
                                @if($record->status==0)
                                    <span class="badge bg-grey-400" >Chưa xem </span>
                                @elseif($record->status==1)
                                    <span class="badge bg-warning-400">Đang xử lý</span>
                                @elseif($record->status==2)
                                    <span class="badge bg-success-400">Xác nhận</span>
                                @elseif($record->status==3)
                                    <span class="badge bg-danger-400">Từ chối</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Phương thức thanh toán:</h6>
                            </td>
                            <td><span>{{$record->payment_method}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Phương thức vận chuyển:</h6>
                            </td>
                            <td><span>{{$record->transport_method}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Tổng đơn hàng:</h6>
                            </td>
                            <td><span>{{number_format($record->total)}}</span></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Thông tin người mua hàng</h5>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <h6 class="mb-0">Họ tên:</h6>
                            </td>
                            <td><span>{{$record->contact}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Số điện thoại:</h6>
                            </td>
                            <td><span>{{$record->mobile}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Email:</h6>
                            </td>
                            <td><span>{{$record->email}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Địa chỉ:</h6>
                            </td>
                            <td><span>{{$record->address}}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="mb-0">Ghi chú:</h6>
                            </td>
                            <td><span>{{$record->note}}</span></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="content">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Sản phẩm</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>
                    <table class="table datatable-basic">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($record->products as $key=>$product)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$product->title}}</td>
                                <td class="text-right">{{number_format($product->price)}}</td>
                                <td class="text-center">{{$product->pivot->quantity}}</td>
                                <td class="text-right">{{number_format($product->pivot->sub_total)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="card">
                        <table class="table datatable-basic">
                            <tbody>
                            <tr>
                                <td>Tổng đơn hàng</td>
                                <td>{{number_format($record->total)}}</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    @parent
    <script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop

