@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content"> 
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thành viên hệ thống</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!--The <code>DataTables</code> is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function. Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example. <strong>Datatables support all available table styling.</strong>-->
        </div>
          <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert bg-success alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ Session::get('success') }}</span>
                    </div>
                @endif
            </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên mã giảm giá</th>
                    <th>Mã code</th>
                    <th>Số lượng</th>
                    <th>Loại giảm</th>
                    <th>Giá trị giảm</th>
                    <th>Điều kiện giảm</th>
                    <th>Trạng thái</th>
                    <!-- <th>Ngày tạo</th> -->
                    <th>Ngày hết hạn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $key=>$coupon)
                <tr>
                    <td>{{$coupon->id}}</td>
                    <td>{{$coupon->coupon_name}}</td>
                    <td>{{$coupon->coupon_code}}</td>
                    <td>{{$coupon->coupon_number}}</td>
                    @if($coupon->coupon_type==1)
                       <td>Theo phần trăm</td>
                        @else  
                        <td>Theo giá tiền</td>
                        @endif
                    
                    @if($coupon->coupon_type==1)
                    <td>{{$coupon->coupon_value}}%</td>
                    @else
                    <td>{{$coupon->coupon_value}}$</td>
                    @endif
                    @if($coupon->coupon_condition>0)
                    <td>Đơn hàng từ {{$coupon->coupon_condition}}$</td>
                    @else
                    <td></td>
                    @endif
                    
                    @if($coupon->coupon_status==0)
                    <td>Ẩn</td>
                    @else
                    <td>Hiển thị</td>
                    @endif
              
                    <td>{{$coupon->coupon_end}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.coupon.edit', $coupon->id)}}" title="Chỉnh sửa" class="success"><i class="icon-pencil"></i></a>   
                        <form action="{!! route('admin.coupon.destroy', $coupon->id) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="Xóa" class="delete text-danger" data-action="delete">
                                <i class="icon-close2"></i>
                            </a>              
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /table header styling -->
    
</div>
<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop