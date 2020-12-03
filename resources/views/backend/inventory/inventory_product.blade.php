@extends('backend.layouts.master')
@section('content')
<!-- Content area -->


  



 
  <!-- Modal -->

               

<body>
<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">





  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">
    

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick = "$('.modal').removeClass('show').addClass('fade');" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->
  

  

  

<div class="content"> 
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Danh sách sản phẩm trong kho</h5>
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
          
            <div class="row">
             <!-- <div class="dropdown" style="margin-left: 20px;">
              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"> </i>
              <span class="caret">Thêm mới</span></button>
              <ul class="dropdown-menu" >
                <li style="margin-left: 10px;"><a href="{{route('admin.import.create')}}">Nhập kho</a></li>
                <li style="margin-left: 10px;"><a href="{{route('admin.export.create',['id' => '0'])}}">Xuất kho</a></li>
              </ul>
            </div> -->

            <div class="dropdown" style="margin-left: 25px;">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-cog"></i>
              <span class="caret"> Thao tác</span></button>
              <ul class="dropdown-menu" >
                <li style="margin-left: 10px;"><a href="" onclick="exceller()">Xuất excel</a></li>
              </ul>
            </div>
            </div>


            
            <script>
              function exceller() {
                var uri = 'data:application/vnd.ms-excel;base64,',
                  template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
                  base64 = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                  },
                  format = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                      return c[p];
                    })
                  }
                var toExcel = document.getElementById("toExcel").innerHTML;
                var ctx = {
                  worksheet: name || '',
                  table: toExcel
                };
                var link = document.createElement("a");
                link.download = "sanpham_nhapkho.xls";
                link.href = uri + base64(format(template, ctx))
                link.click();
              }

            </script>
        
           <table id="toExcel" class="table datatable-basic table-bordered">
            <thead>
                <tr>
                    <th>Inventory ID</th>
                    <th>Sản phẩm</th>
                    <th>Tồn kho</th>
                    <th>Thực kiểm</th>
                    <th>Chênh lệch</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
             <tbody>
                 @foreach($records as $key => $record)
                 <tr>
                    <td>{{$record->inventory_id}}</td>
                    <td>{{$record->title}}</td>
                    <td>{{$record->exist}}</td>
                    <td>{{$record->real}}</td>
                    @if($record->difference >0)
                    <td>Thiếu {{$record->difference}}</td>
                    @elseif($record->difference <0)
                    <td>Thừa {{str_replace( array('-') , '', $record->difference )}} </td> 
                    @elseif($record->difference ==0)
                    <td>Khớp</td>
                    @endif
                    <td class="text-center">
                        
                        <a href="{{route('admin.inventory.edit', $record->inventory_id)}}" title="Chỉnh sửa" class="success"><i class="icon-pencil"></i></a>   
                        <form action="{!! route('admin.inventory.destroy', $record->inventory_id) !!}" method="POST" style="display: inline-block">
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
    <!-- modal -->

  
</div>
    

</body>
 <script type="text/javascript">
            jQuery('#cd-dropdown').on('change', function(){
                if(jQuery(this).val() == 1){
                    window.location.href = 'http://google.com'
                }
                else if(jQuery(this).val() == 2){
                    window.location.href = 'http://noithat-1118.abc:81/admin/stock/import_create'   
                }
                // and so on
                })
        </script>
<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop