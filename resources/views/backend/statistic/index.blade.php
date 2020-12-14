@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<style type="text/css">
    p.title_thongke{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
</style>
<head>
    <script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <script type="text/javascript">
        
        $( document ).ready(function() {

            $('#btn-dashboard-filter').click(function()
    {
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        
        $.ajax({
            url:'{{route("admin.statistic.filter")}}',
            method: "POST",
            dataType: "JSON",
            data:{from_date:from_date,_token:_token,to_date:to_date},
            success:function(data){
                chart.setData(data);

            }
        });
    });

            $('.dashboard-filter').change(function(){

                var dashboard_value = $(this).val();
                var _token = $('input[name = "_token"]').val();
                $('#loading').show();
                $.ajax({
                    url:'{{route("admin.fixed.filter")}}',
                    method:"POST",
                    dataType: "JSON",
                    data:{dashboard_value:dashboard_value, _token:_token},
                    
                    success:function(data){
                        $('#loading').hide();  
                        chart.setData(data);
                      
                    }


                });
            });


            //chart30daysorder();

             var chart = new Morris.Line({
          
          element: 'chart',
          
          lineColors: ['#819C79','#fc8710','#FF6541','#A4ADD3','#766B56'],
          pointFillColors: ['#ffffff'],
          pointStrokeColors:['black'],
            fillOpacity:0.3,
            hideHover: 'auto',
            parseTime: false,

          xkey: 'period',
          
          ykeys: ['order','sales','profit','quantity'],
          
          labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
        });

        });


           
   
    
</script>

<script type="text/javascript">
        
        $( document ).ready(function() {

            $('#btn-dashboard-filter').click(function()
    {
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        
        $.ajax({
            url:'{{route("admin.statistic.filter")}}',
            method: "POST",
            dataType: "JSON",
            data:{from_date:from_date,_token:_token,to_date:to_date},
            success:function(data){
                chart.setData(data);

            }
        });
    });

            $('.dashboard-filter').change(function(){

                var dashboard_value = $(this).val();
                var _token = $('input[name = "_token"]').val();
                $('#loading').show();
                $.ajax({
                    url:'{{route("admin.fixed.filter")}}',
                    method:"POST",
                    dataType: "JSON",
                    data:{dashboard_value:dashboard_value, _token:_token},
                    
                    success:function(data){
                        $('#loading').hide();  
                        chart.setData(data);
                      
                    }


                });
            });


            //chart30daysorder();

           


           
   
    
</script>

<script type="text/javascript">
        
        $( document ).ready(function() {
            
            var colorDanger = "#FF1744";
           var chart = new Morris.Donut({
              element: 'donut',
              resize: true,
              colors: [
                '#E0F7FA',
                '#a86f32',
                '#96a832',
                '#325ba8',
                '#26C6DA',
                '#00BCD4',
                '#00ACC1',
                '#0097A7',
                '#00838F',
                '#006064'
              ],
              //labelColor:"#cccccc", // text color
              //backgroundColor: '#333333', // border color
              data: [
                {label:"Sản phẩm", value:<?php echo $product ?>, color:colorDanger},
                {label:"Đơn hàng", value:<?php echo $bill ?>},
                {label:"Khách hàng", value:<?php echo $member ?>},
                {label:"Nhà cung cấp", value:<?php echo $supplier ?>},
                
              ]
            });

            

        });


           
   
    
</script>


<script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            prevText:"Tháng trước",
            NextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3","Thứ 4","Thứ 5", "Thứ 6","Thứ 7","Chủ nhật"],
            duration:"slow",
        });

        $( "#datepicker2" ).datepicker({
            prevText:"Tháng trước",
            NextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3","Thứ 4","Thứ 5", "Thứ 6","Thứ 7","Chủ nhật"],
            duration:"slow",
        });
  } );

</script>
</head>
<div class="content"> 
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thống kê</h5>
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


            <p class="title_thongke">Thông kế đơn hàng doanh số</p>
         
            <form autocomplete="off">
                @csrf
                <div class="col-md-2">
                    <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                    

                </div>

                <div class="col-md-2" >
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                </div>
                

                <div class="col-md-2" >
                    <p>
                        Lọc theo: 
                        <select class="dashboard-filter form-control">
                            <option>--Chọn--</option>
                            <option value="7ngay">7 ngày qua </option>
                            <option value="thangtruoc">tháng trước </option>
                            <option value="thangnay">tháng này </option>
                            <option value="365ngayqua">365 ngày qua </option>
                            
                            
                        </select>

                    </p>
                    

                </div>
                <div style="display: none;color:#00BFFF;" id=loading>Loading ...</div>
            </form>

            <div class="col-md-12">
                <div id=chart style="height: 250px;"></div>
            </div>


            <br><br><p class="title_thongke">Thống kê sản phẩm, đơn hàng, khách hàng, nhà cung cấp</p>
            <div class="col-md-12" >
                
                <div id="donut"  style="height: 250px;"></div>
            </div>
        
        
    </div>
    <!-- /table header styling -->
    
</div>

<!-- /content area -->
@stop
@section('script')
@parent
  
  