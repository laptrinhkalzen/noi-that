@extends('backend.layouts.master1')
@section('content1')
<!-- Content area -->


  
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
  

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item">
                 
                       <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Chọn kho
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                             @foreach($stocks as $stock1)
                                <li style="margin-left: 10px;"><a href="{{route('admin.bill.create',['stock_id' => $stock1->id])}}">{{$stock1->name}}</a></li>
                             @endforeach
                          </ul>
                        </div>
                    </li>
                </ul>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  

<div class="content"> 
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Đơn bán hàng</h5>
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
             <div class="dropdown" style="margin-left: 20px;">
              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"> </i>
              <span class="caret">Thêm mới</span></button>
              <ul class="dropdown-menu" >
               <!--  <li style="margin-left: 10px; color:blue;"><a href="" data-toggle="modal" data-target="#myModal">Lập hóa đơn</a></li> -->
               <li style="margin-left: 10px;"><a href="{{route('admin.bill.create',['stock_id' => 1])}}">Thêm mới</a></li>
              </ul>
            </div>

            <div class="dropdown" style="margin-left: 10px;">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-cog"></i>
              <span class="caret"> Thao tác</span></button>
              <ul class="dropdown-menu" >
                <li style="margin-left: 10px;"><a href="{!! route('admin.bill.export') !!}" onclick="">Xuất excel</a></li>
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
                link.download = "don_hang.xls";
                link.href = uri + base64(format(template, ctx))
                link.click();
              }

            </script>
        
           <table id="toExcel" class="table datatable-basic table-bordered">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>ID</th>
                    <th>Kho hàng</th>
                    <th>Người bán</th>
                    <th>Khách hàng</th>
                    <th>Tổng đơn hàng</th>
                    <th>Chiết khấu</th>
                    <th>Tổng thanh toán</th>
                    <th>Đã thanh toán</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
             <tbody>
                 @foreach($records as $key => $record)
                   
                 <tr>
                    <th>{{$record->created_at}}</th>
                    <th>{{$record->bill_id}}</th>
                    <th><a target="_blank" href="{{route('admin.stock.edit',['id'=>$record->stock_id])}}">{{$record->stock_name}}</a></th>
                    <th><a target="_blank" href="{{route('admin.user.edit',['id'=>$record->user_id])}}">{{$record->user_name}}</a></th>
                    <th><a target="_blank" href="{{route('admin.member.edit',['id'=>$record->customer_id])}}">{{$record->customer_name}}</a></th>
                    <th>{{$record->total}}</th>
                    <th>{{$record->discount}}</th>
                    <th>{{$record->total_payment}}</th>
                    <th>{{$record->customer_payment}}</th>
                    
                    @if($record->note!=null)
                    <th>{{$record->note}}</th>
                    @else
                    <th></th>
                    @endif
                    <td class="text-center">
                        <a  href="{!! route('admin.print.edit_bill', ['id' => $record->bill_id, 'stock_id' => $record->stock_id]) !!}" class="success"><i class="fa fa-print"></i></a>
                        <a href="{!! route('admin.bill.edit', ['id' => $record->bill_id, 'stock_id' => $record->stock_id]) !!}" title="Chỉnh sửa" class="success"><i class="icon-pencil"></i></a>   
                        <form action="{!! route('admin.bill.destroy', $record->bill_id) !!}" method="POST" style="display: inline-block">
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