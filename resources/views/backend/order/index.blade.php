@extends('backend.layouts.master')
@section('content')
    <!-- Content area -->
    <div class="content">
        <!-- Table header styling -->
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
                    <th>#</th>
                    <th>Người mua</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $key=>$record)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$record->contact}}</td>
                        <td>{{$record->mobile}}</td>
                        <td>
                            @if($record->status==0)
                                <span class="badge bg-grey-400">Chưa xem </span>
                            @elseif($record->status==1)
                                <span class="badge bg-warning-400">Đang xử lý</span>
                            @elseif($record->status==2)
                                <span class="badge bg-success-400">Xác nhận</span>
                            @elseif($record->status==3)
                                <span class="badge bg-danger-400">Từ chối</span>
                            @endif
                        </td>
                        <td>{{$record->created_at()}}</td>
                        <td class="text-center">
                            <a href="{{route('admin.order.edit', $record->id)}}" title="{!! trans('base.show') !!}" class="success"><i class="icon-eye"></i></a>
                            <form action="{!! route('admin.order.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
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
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop
