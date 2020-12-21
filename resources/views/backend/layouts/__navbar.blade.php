<!--Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
  <script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
        <div class="media-body">
                        <img style="width:48px; height: 48px;" src="{{asset('upload/images2/nhanh3.jpg')}}" alt="picture" class="">
                    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
            

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img style="object-fit: cover" src="{{\Auth::user()->avatar}}" class="rounded-circle mr-2" height="34" width="34" alt="">
                    <span>{{\Auth::user()->full_name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.user.index_profile', ['id' => \Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Thông tin tài khoản</a>
                    <a href="javascript:void(0)" data-action="logout" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->



<!-- Secondary navbar -->
    <div class="navbar navbar-expand-md navbar-light">
        <div class="text-center d-md-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
                <i class="icon-unfold mr-2"></i>
                Navigation
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="navbar-nav-link active">
                        <i class="icon-home4 mr-2"></i>
                        Dashboard
                    </a>
                </li>

               <!--  <li class="nav-item dropdown">
                    <a href="{{route('admin.config.index')}}" class="navbar-nav-link active" >
                        <i class="fa fa-atom mr-2"></i>
                        Cấu hình website
                    </a>

                    
                </li> -->
                <div style="width: 100%;margin:0 auto;text-align:center;">
   <form role="form" action="//track.trackingmore.com" method="get" onsubmit="return false">
       <div class="TM_input-group">
           <input type="text" class="TM_my_search_input_style " id="button_tracking_number" placeholder="Tracking Number" name="button_tracking_number" value="" autocomplete="off" maxlength="100" style="border-color: #0099CC">
           <span class="TM_input-group-btn">
               <button class="TM_my_search_button_style " id="query" type="button" onclick="return doTrack()" style="background-color: #0099CC">Track</button>
           </span>
       </div>
       <input type="hidden" name="lang" value="en" />
       <input id="button_express_code" type="hidden" name="lang" value="iceland-post" />
   </form>
   <div id="TRNum"></div>
</div>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user mr-2"></i>
                        Người dùng
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{route('admin.user.index')}}" class="dropdown-item"><i class="fa fa-address-card mr-2"></i> Thành viên hệ thống</a>
                        <a href="{{route('admin.role.index')}}" class="dropdown-item"><i class="fa fa-handshake mr-2"></i> Quyền</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-couch mr-2"></i>
                    Sản phẩm
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{route('admin.category.index', \App\Category::TYPE_PRODUCT)}}" class="dropdown-item"><i class="fa fa-list mr-2"></i> Danh mục</a>
                        <a href="{{route('admin.product.index')}}" class="dropdown-item"><i class="fa fa-couch mr-2"></i> Sản phẩm</a>
                        <a href="{{route('admin.attribute.index')}}" class="dropdown-item"><i class="fa fa-cube mr-2"></i> Thuộc tính</a>
                    </div>
                </li>
                

                 <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-warehouse"></i>
                        Kho
                    </a>
                    
                    <ul class="dropdown-menu">
                        <a href="{{route('admin.stock.index')}}" class="dropdown-item"><i class="fa fa-home mr-2"></i> Kho</a>
                        <a href="{{route('admin.stock.product')}}" class="dropdown-item"><i class="fa fa-list mr-2"></i>Danh sách sản phẩm</a>
                         <li class="dropdown dropdown-submenu"> <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-exchange mr-2"></i>
                        Nhập xuất kho
                        </a>
                    <ul class="dropdown-menu">
                         
                        <a href="{{route('admin.import.index')}}" class="dropdown-item"><i class="fa fa-file mr-2"></i>Phiếu nhập kho</a>
                        <a href="{{route('import.product')}}" class="dropdown-item"><i class="fa fa-list-ul mr-2"></i>Sản phẩm nhập kho</a>
                      </ul>
                    </li>
                      <li class="dropdown dropdown-submenu"> <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-pencil mr-2"></i>
                        Kiểm kho
                    </a>
                    <ul class="dropdown-menu">
                         
                        <a href="{{route('admin.inventory.index')}}" class="dropdown-item"><i class="fa fa-file-code mr-2"></i>Phiếu kiểm kho</a>
                        <a href="{{route('admin.inventory.product')}}" class="dropdown-item"><i class="fa fa-hdd mr-2"></i>Sản phẩm kiểm kho</a>
                      </ul>
                    </li>
               
                        <a href="{{route('admin.supplier.index')}}" class="dropdown-item"><i class="fa fa-spinner mr-2"></i> Nhà cung cấp</a>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Bán hàng
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{route('admin.bill.index1')}}" class="dropdown-item"><i class="fa fa-bug mr-2"></i>Đơn hàng</a>
                        <a href="{{route('admin.transport.index')}}" class="dropdown-item"><i class="fa fa-truck mr-2"></i>Đơn vị vận chuyển</a>
                  
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-head-side mr-2"></i>
                        Khách hàng
                    </a>

                    <div class="dropdown-menu">
                        <!-- <a href="{{route('admin.subscriber.index')}}" class="dropdown-item"><i class="icon-align-center-horizontal"></i> Người đăng ký</a>
                        <a href="{{route('admin.contact.index')}}" class="dropdown-item"><i class="icon-align-center-horizontal"></i> Liên hệ</a> -->
                        <a href="{{route('admin.member.index')}}" class="dropdown-item"><i class="fa fa-head-side mr-2"></i> Khách hàng</a>
                        <a href="{{route('admin.group.index')}}" class="dropdown-item"><i class="fa fa-address-book mr-2"></i> Loại khách hàng</a>
                        <a href="{{route('admin.rank.index')}}" class="dropdown-item"><i class="fa fa-list mr-2"></i> Danh mục cấp bậc</a> 
                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gift mr-2"></i>
                        Mã giảm giá
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{route('admin.coupon.index')}}" class="dropdown-item"><i class="fa fa-gift mr-2"></i> Mã giảm giá</a>
                        
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gift mr-2"></i>
                        Thống kê
                    </a>

                    <div class="dropdown-menu">
                        <a href="{{route('admin.statistic.index')}}" class="dropdown-item"><i class="fa fa-gift mr-2"></i> Thống kê phiếu kiểm kho</a>
                        
                        
                        
                    </div>

                   
                </li>
                
            </ul>

            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-make-group mr-2"></i>
                        Connect
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                        <div class="dropdown-content-body p-2">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-4">
                                    <a href="https://github.com/" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-github4 icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Github</div>
                                    </a>

                                    <a href="https://www.dropbox.com/?landing=dbv2" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-dropbox text-blue-400 icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Dropbox</div>
                                    </a>
                                </div>
                                
                                <div class="col-12 col-sm-4">
                                    <a href="https://dribbble.com/" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-dribbble3 text-pink-400 icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Dribbble</div>
                                    </a>

                                    <a href="https://drive.google.com/" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-google-drive text-success-400 icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Drive</div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <a href="https://twitter.com/?lang=en" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-twitter text-info-400 icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Twitter</div>
                                    </a>

                                    <a href="https://www.youtube.com/" class="d-block text-default text-center ripple-dark rounded p-3">
                                        <i class="icon-youtube text-danger icon-2x"></i>
                                        <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Youtube</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="d-md-none ml-2">Settings</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                        <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                        <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <!-- /secondary navbar-nav