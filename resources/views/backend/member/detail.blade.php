
@extends('backend.layouts.master')
@section('content')
    <div class="content">

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Thông tin chi tiết thành viên</h5>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td>
                        <h6 class="mb-0">Họ tên:</h6>
                    </td>
                    <td><span>{{$record->full_name}}</span></td>
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
                        <h6 class="mb-0">Tên công ty:</h6>
                    </td>
                    <td><span>{{$record->company_name}}</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="mb-0">Địa chỉ:</h6>
                    </td>
                    <td><span>{{$record->address}}</span></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
@stop
@section('script')
    @parent
    <script>
        //initiate the plugin and pass the id of the div containing gallery images
        $('#zoom_image').ezPlus({
            constrainType: 'height', constrainSize: 400,
            containLensZoom: true, gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: 'active'
        });

        //pass the images to Fancybox
        $('#zoom_image').bind('click', function (e) {
            var ez = $('#zoom_image').data('ezPlus');
            $.fancyboxPlus(ez.getGalleryList());
            return false;
        });
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-114782204-1');
    </script>
@stop

