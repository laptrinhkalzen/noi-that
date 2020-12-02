<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'admin.index', 'uses' => 'Backend\BackendController@index']);
    /* Cấu hình website */
    Route::get('/config', ['as' => 'admin.config.index', 'uses' => 'Backend\ConfigController@index']);
    Route::post('/config/update/{id}', ['as' => 'admin.config.update', 'uses' => 'Backend\ConfigController@update']);

    /* Quản lý danh mục */
    Route::get('/category/{type}', ['as' => 'admin.category.index', 'uses' => 'Backend\CategoryController@index']);
    Route::get('/category/{type}/create', ['as' => 'admin.category.create', 'uses' => 'Backend\CategoryController@create']);
    Route::get('/category/{type}/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Backend\CategoryController@edit']);
    Route::post('/category/{type}/store', ['as' => 'admin.category.store', 'uses' => 'Backend\CategoryController@store']);
    Route::post('/category/{type}/update/{id}', ['as' => 'admin.category.update', 'uses' => 'Backend\CategoryController@update']);
    Route::delete('/category/{type}/delete/{id}', ['as' => 'admin.category.destroy', 'uses' => 'Backend\CategoryController@destroy']);

    /* Quản lý video */
    Route::get('/video', ['as' => 'admin.video.index', 'uses' => 'Backend\VideoController@index']);
    Route::get('/video/create', ['as' => 'admin.video.create', 'uses' => 'Backend\VideoController@create']);
    Route::post('/video/store', ['as' => 'admin.video.store', 'uses' => 'Backend\VideoController@store']);
    Route::get('/video/edit/{id}', ['as' => 'admin.video.edit', 'uses' => 'Backend\VideoController@edit']);
    Route::post('/video/update/{id}', ['as' => 'admin.video.update', 'uses' => 'Backend\VideoController@update']);
    Route::delete('/video/delete/{id}', ['as' => 'admin.video.destroy', 'uses' => 'Backend\VideoController@destroy']);

    /* Quản lý news */
    Route::get('/news', ['as' => 'admin.news.index', 'uses' => 'Backend\NewsController@index']);
    Route::get('/news/create', ['as' => 'admin.news.create', 'uses' => 'Backend\NewsController@create']);
    Route::post('/news/store', ['as' => 'admin.news.store', 'uses' => 'Backend\NewsController@store']);
    Route::get('/news/edit/{id}', ['as' => 'admin.news.edit', 'uses' => 'Backend\NewsController@edit']);
    Route::post('/news/update/{id}', ['as' => 'admin.news.update', 'uses' => 'Backend\NewsController@update']);
    Route::delete('/news/delete/{id}', ['as' => 'admin.news.destroy', 'uses' => 'Backend\NewsController@destroy']);

    /* Quản lý supplier */
    Route::get('/supplier', ['as' => 'admin.supplier.index', 'uses' => 'Backend\SupplierController@index']);
    Route::get('/supplier/create', ['as' => 'admin.supplier.create', 'uses' => 'Backend\SupplierController@create']);
    Route::post('/supplier/store', ['as' => 'admin.supplier.store', 'uses' => 'Backend\SupplierController@store']);
    Route::get('/supplier/edit/{id}', ['as' => 'admin.supplier.edit', 'uses' => 'Backend\SupplierController@edit']);
    Route::post('/supplier/update/{id}', ['as' => 'admin.supplier.update', 'uses' => 'Backend\SupplierController@update']);
    Route::delete('/supplier/delete/{id}', ['as' => 'admin.supplier.destroy', 'uses' => 'Backend\SupplierController@destroy']);

    /* Quản lý Stock */
    Route::get('/stock', ['as' => 'admin.stock.index', 'uses' => 'Backend\StockController@index']);
    Route::get('/stock/create', ['as' => 'admin.stock.create', 'uses' => 'Backend\StockController@create']);
    Route::post('/stock/store', ['as' => 'admin.stock.store', 'uses' => 'Backend\StockController@store']);

    //nhap kho
    Route::get('/stock/import_index', ['as' => 'admin.import.index', 'uses' => 'Backend\StockController@import_index']);
    Route::get('/stock/import_create', ['as' => 'admin.import.create', 'uses' => 'Backend\StockController@import_create']);
    Route::post('/stock/import_store', ['as' => 'admin.import.store', 'uses' => 'Backend\StockController@import_store']);
    Route::get('/stock/import_edit/{id}', ['as' => 'admin.import.edit', 'uses' => 'Backend\StockController@import_edit']);
    Route::post('/stock/import_update/{id}', ['as' => 'admin.import.update', 'uses' => 'Backend\StockController@import_update']);
    Route::delete('/stock/import_delete/{id}', ['as' => 'admin.import.destroy', 'uses' => 'Backend\StockController@import_destroy']);
    Route::get('/print/edit_import/{id}', ['as' => 'admin.print.edit_import', 'uses' => 'Backend\StockController@print']);

    //xuatkho
    Route::get('/stock/export_index', ['as' => 'admin.export.index', 'uses' => 'Backend\StockController@export_index']);
    Route::get('/stock/export_create/{id}', ['as' => 'admin.export.create', 'uses' => 'Backend\StockController@export_create']);
    Route::post('/stock/export_store', ['as' => 'admin.export.store', 'uses' => 'Backend\StockController@export_store']);
    
    //kho
    Route::get('/stock/edit/{id}', ['as' => 'admin.stock.edit', 'uses' => 'Backend\StockController@edit']);
    Route::post('/stock/update/{id}', ['as' => 'admin.stock.update', 'uses' => 'Backend\StockController@update']);
    Route::delete('/stock/delete/{id}', ['as' => 'admin.stock.destroy', 'uses' => 'Backend\StockController@destroy']);

    //chuyen kho

 

    //bill
    Route::get('/bill', ['as' => 'admin.bill.index1', 'uses' => 'Backend\BillController@index']);
    Route::get('/bill/create/{stock_id}', ['as' => 'admin.bill.create', 'uses' => 'Backend\BillController@create']);
    Route::post('/bill/store/{stock_id}', ['as' => 'admin.bill.store', 'uses' => 'Backend\BillController@store']);
    Route::get('/bill/edit/{id}/{stock_id}', ['as' => 'admin.bill.edit', 'uses' => 'Backend\billController@edit']);
    Route::post('/bill/update/{id}/{stock_id}', ['as' => 'admin.bill.update', 'uses' => 'Backend\billController@update']);
    Route::delete('/bill/delete/{id}', ['as' => 'admin.bill.destroy', 'uses' => 'Backend\billController@destroy']);
    Route::get('/print/edit_bill/{id}', ['as' => 'admin.print.edit_bill', 'uses' => 'Backend\billController@print']);
    

    /* Quản lý product */
    Route::get('/product', ['as' => 'admin.product.index', 'uses' => 'Backend\ProductController@index']);
    Route::get('/product/create', ['as' => 'admin.product.create', 'uses' => 'Backend\ProductController@create']);
    Route::post('/product/store', ['as' => 'admin.product.store', 'uses' => 'Backend\ProductController@store']);
    Route::get('/product/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Backend\ProductController@edit']);
    Route::post('/product/update/{id}', ['as' => 'admin.product.update', 'uses' => 'Backend\ProductController@update']);
    Route::delete('/product/delete/{id}', ['as' => 'admin.product.destroy', 'uses' => 'Backend\ProductController@destroy']);

     

    /* Quản lý attribute */
    Route::get('/attribute', ['as' => 'admin.attribute.index', 'uses' => 'Backend\AttributeController@index']);
    Route::get('/attribute/create', ['as' => 'admin.attribute.create', 'uses' => 'Backend\AttributeController@create']);
    Route::post('/attribute/store', ['as' => 'admin.attribute.store', 'uses' => 'Backend\AttributeController@store']);
    Route::get('/attribute/edit/{id}', ['as' => 'admin.attribute.edit', 'uses' => 'Backend\AttributeController@edit']);
    Route::post('/attribute/update/{id}', ['as' => 'admin.attribute.update', 'uses' => 'Backend\AttributeController@update']);
    Route::delete('/attribute/delete/{id}', ['as' => 'admin.attribute.destroy', 'uses' => 'Backend\AttributeController@destroy']);

    /* Quản lý hạng mục */
    Route::get('/item', ['as' => 'admin.item.index', 'uses' => 'Backend\ItemController@index']);
    Route::get('/item/create', ['as' => 'admin.item.create', 'uses' => 'Backend\ItemController@create']);
    Route::post('/item/store', ['as' => 'admin.item.store', 'uses' => 'Backend\ItemController@store']);
    Route::get('/item/edit/{id}', ['as' => 'admin.item.edit', 'uses' => 'Backend\ItemController@edit']);
    Route::post('/item/update/{id}', ['as' => 'admin.item.update', 'uses' => 'Backend\ItemController@update']);
    Route::delete('/item/delete/{id}', ['as' => 'admin.item.destroy', 'uses' => 'Backend\ItemController@destroy']);

    /* Quản lý đơn vị thi công */
    Route::get('/construction', ['as' => 'admin.construction.index', 'uses' => 'Backend\ConstructionController@index']);

    Route::get('/construction/edit/{id}', ['as' => 'admin.construction.edit', 'uses' => 'Backend\ConstructionController@edit']);
    Route::post('/construction/update/{id}', ['as' => 'admin.construction.update', 'uses' => 'Backend\ConstructionController@update']);
    Route::delete('/construction/delete/{id}', ['as' => 'admin.construction.destroy', 'uses' => 'Backend\ConstructionController@destroy']);

    /* Quản lý dự án */
    Route::get('/project', ['as' => 'admin.project.index', 'uses' => 'Backend\ProjectController@index']);
    Route::get('/project/edit/{id}', ['as' => 'admin.project.edit', 'uses' => 'Backend\ProjectController@edit']);
    Route::post('/project/update/{id}', ['as' => 'admin.project.update', 'uses' => 'Backend\ProjectController@update']);
    Route::delete('/project/delete/{id}', ['as' => 'admin.project.destroy', 'uses' => 'Backend\ProjectController@destroy']);

    /* Quản lý đơn vị thi công */
    Route::get('/review', ['as' => 'admin.review.index', 'uses' => 'Backend\ReviewController@index']);
    Route::delete('/review/delete/{id}', ['as' => 'admin.review.destroy', 'uses' => 'Backend\ReviewController@destroy']);

    /* Quản lý gallery */
    Route::get('/gallery', ['as' => 'admin.gallery.index', 'uses' => 'Backend\GalleryController@index']);
    Route::get('/gallery/create', ['as' => 'admin.gallery.create', 'uses' => 'Backend\GalleryController@create']);
    Route::post('/gallery/store', ['as' => 'admin.gallery.store', 'uses' => 'Backend\GalleryController@store']);
    Route::get('/gallery/edit/{id}', ['as' => 'admin.gallery.edit', 'uses' => 'Backend\GalleryController@edit']);
    Route::post('/gallery/update/{id}', ['as' => 'admin.gallery.update', 'uses' => 'Backend\GalleryController@update']);
    Route::delete('/gallery/delete/{id}', ['as' => 'admin.gallery.destroy', 'uses' => 'Backend\GalleryController@destroy']);

    /* Quản lý danh mục cấp bậc */
    Route::get('/rank', ['as' => 'admin.rank.index', 'uses' => 'Backend\RankController@index']);
    Route::get('/rank/create', ['as' => 'admin.rank.create', 'uses' => 'Backend\RankController@create']);
    Route::post('/rank/store', ['as' => 'admin.rank.store', 'uses' => 'Backend\RankController@store']);
    Route::get('/rank/edit/{id}', ['as' => 'admin.rank.edit', 'uses' => 'Backend\RankController@edit']);
    Route::post('/rank/update/{id}', ['as' => 'admin.rank.update', 'uses' => 'Backend\RankController@update']);
    Route::delete('/rank/delete/{id}', ['as' => 'admin.rank.destroy', 'uses' => 'Backend\RankController@destroy']);

    /* Quản lý danh mục cấp bậc */
    Route::get('/marketing', ['as' => 'admin.marketing.index', 'uses' => 'Backend\MarketingController@index']);
    Route::get('/marketing/edit/{id}', ['as' => 'admin.marketing.edit', 'uses' => 'Backend\MarketingController@edit']);
    Route::post('/marketing/update/{id}', ['as' => 'admin.marketing.update', 'uses' => 'Backend\MarketingController@update']);
    Route::delete('/marketing/delete/{id}', ['as' => 'admin.marketing.destroy', 'uses' => 'Backend\MarketingController@destroy']);

    /* Quản lý user */
    Route::get('/user', ['as' => 'admin.user.index', 'uses' => 'Backend\UserController@index']);
    Route::get('/user/create', ['as' => 'admin.user.create', 'uses' => 'Backend\UserController@create']);
    Route::post('/user/store', ['as' => 'admin.user.store', 'uses' => 'Backend\UserController@store']);
    Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Backend\UserController@edit']);
    Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'Backend\UserController@update']);
    Route::delete('/user/delete/{id}', ['as' => 'admin.user.destroy', 'uses' => 'Backend\UserController@destroy']);

    Route::get('/user/edit_profile/{id}', ['as' => 'admin.user.index_profile', 'uses' => 'Backend\UserController@editProfile']);
    Route::post('/user/update_profile/{id}', ['as' => 'admin.user.update_profile', 'uses' => 'Backend\UserController@updateProfile']);
    /* Quản lý quyền */
    Route::get('/role', ['as' => 'admin.role.index', 'uses' => 'Backend\RoleController@index']);
    Route::get('/role/create', ['as' => 'admin.role.create', 'uses' => 'Backend\RoleController@create']);
    Route::post('/role/store', ['as' => 'admin.role.store', 'uses' => 'Backend\RoleController@store']);
    Route::get('/role/edit/{id}', ['as' => 'admin.role.edit', 'uses' => 'Backend\RoleController@edit']);
    Route::post('/role/update/{id}', ['as' => 'admin.role.update', 'uses' => 'Backend\RoleController@update']);
    Route::delete('/role/delete/{id}', ['as' => 'admin.role.destroy', 'uses' => 'Backend\RoleController@destroy']);

    /* Menu*/
    Route::get('/menu', ['as' => 'admin.menu.index', 'uses' => 'Backend\MenuController@index']);
    Route::get('/menu/create', ['as' => 'admin.menu.create', 'uses' => 'Backend\MenuController@create']);
    Route::get('/menu/edit/{id}', ['as' => 'admin.menu.edit', 'uses' => 'Backend\MenuController@edit']);
    Route::post('/menu/store', ['as' => 'admin.menu.store', 'uses' => 'Backend\MenuController@store']);
    Route::post('/menu/update/{id}', ['as' => 'admin.menu.update', 'uses' => 'Backend\MenuController@update']);
    Route::delete('/menu/delete/{id}', ['as' => 'admin.menu.destroy', 'uses' => 'Backend\MenuController@destroy']);
    /* Block*/
    Route::get('/block', ['as' => 'admin.block.index', 'uses' => 'Backend\BlockController@index']);
    Route::get('/block/create', ['as' => 'admin.block.create', 'uses' => 'Backend\BlockController@create']);
    Route::get('/block/edit/{id}', ['as' => 'admin.block.edit', 'uses' => 'Backend\BlockController@edit']);
    Route::post('/block/store', ['as' => 'admin.block.store', 'uses' => 'Backend\BlockController@store']);
    Route::post('/block/update/{id}', ['as' => 'admin.block.update', 'uses' => 'Backend\BlockController@update']);
    Route::delete('/block/delete/{id}', ['as' => 'admin.block.destroy', 'uses' => 'Backend\BlockController@destroy']);
    /* Slide*/
    Route::get('/slide', ['as' => 'admin.slide.index', 'uses' => 'Backend\SlideController@index']);
    Route::get('/slide/create', ['as' => 'admin.slide.create', 'uses' => 'Backend\SlideController@create']);
    Route::get('/slide/edit/{id}', ['as' => 'admin.slide.edit', 'uses' => 'Backend\SlideController@edit']);
    Route::post('/slide/store', ['as' => 'admin.slide.store', 'uses' => 'Backend\SlideController@store']);
    Route::post('/slide/update/{id}', ['as' => 'admin.slide.update', 'uses' => 'Backend\SlideController@update']);
    Route::delete('/slide/delete/{id}', ['as' => 'admin.slide.destroy', 'uses' => 'Backend\SlideController@destroy']);
    /* Dịch vụ*/
    Route::get('/service', ['as' => 'admin.service.index', 'uses' => 'Backend\ServiceController@index']);
    Route::get('/service/create', ['as' => 'admin.service.create', 'uses' => 'Backend\ServiceController@create']);
    Route::get('/service/edit/{id}', ['as' => 'admin.service.edit', 'uses' => 'Backend\ServiceController@edit']);
    Route::post('/service/store', ['as' => 'admin.service.store', 'uses' => 'Backend\ServiceController@store']);
    Route::post('/service/update/{id}', ['as' => 'admin.service.update', 'uses' => 'Backend\ServiceController@update']);
    Route::delete('/service/delete/{id}', ['as' => 'admin.service.destroy', 'uses' => 'Backend\ServiceController@destroy']);
    /* Người đăng kí*/
    Route::get('/subscriber', ['as' => 'admin.subscriber.index', 'uses' => 'Backend\SubscriberController@index']);
    Route::delete('/subscriber/delete/{id}', ['as' => 'admin.subscriber.destroy', 'uses' => 'Backend\SubscriberController@destroy']);
    /* Liên hệ*/
    Route::get('/contact', ['as' => 'admin.contact.index', 'uses' => 'Backend\ContactController@index']);
    Route::delete('/contact/delete/{id}', ['as' => 'admin.contact.destroy', 'uses' => 'Backend\ContactController@destroy']);
    Route::get('/contact/show/{id}', ['as' => 'admin.contact.edit', 'uses' => 'Backend\ContactController@show']);
    /* Thành viên*/
    Route::get('/member', ['as' => 'admin.member.index', 'uses' => 'Backend\MemberController@index']);
    Route::delete('/member/delete/{id}', ['as' => 'admin.member.destroy', 'uses' => 'Backend\MemberController@destroy']);
    Route::get('/member/create', ['as' => 'admin.member.create', 'uses' => 'Backend\MemberController@create']);
    Route::post('/member/store', ['as' => 'admin.member.store', 'uses' => 'Backend\MemberController@store']);
    Route::get('/member/edit/{id}', ['as' => 'admin.member.edit', 'uses' => 'Backend\MemberController@edit']);
    Route::post('/member/update/{id}', ['as' => 'admin.member.update', 'uses' => 'Backend\MemberController@update']);
    Route::get('/member/show/{id}', ['as' => 'admin.member.show', 'uses' => 'Backend\MemberController@show']);
    /*Nhóm thành viên*/
    Route::get('/group', ['as' => 'admin.group.index', 'uses' => 'Backend\GroupController@index']);
    Route::delete('/group/delete/{id}', ['as' => 'admin.group.destroy', 'uses' => 'Backend\GroupController@destroy']);
    Route::get('/group/create', ['as' => 'admin.group.create', 'uses' => 'Backend\GroupController@create']);
    Route::post('/group/store', ['as' => 'admin.group.store', 'uses' => 'Backend\GroupController@store']);
    Route::get('/group/edit/{id}', ['as' => 'admin.group.edit', 'uses' => 'Backend\GroupController@edit']);
    Route::post('/group/update/{id}', ['as' => 'admin.group.update', 'uses' => 'Backend\GroupController@update']);
    
    /* Đơn hàng*/
    Route::get('/order', ['as' => 'admin.order.index', 'uses' => 'Backend\OrderController@index']);
    Route::delete('/order/delete/{id}', ['as' => 'admin.order.destroy', 'uses' => 'Backend\OrderController@destroy']);
    Route::get('/order/show/{id}', ['as' => 'admin.order.edit', 'uses' => 'Backend\OrderController@show']);
     /* Template_seting*/
    Route::get('/template_setting', ['as' => 'admin.template_setting.index', 'uses' => 'Backend\TemplateSettingController@index']);
    Route::get('/template_setting/create', ['as' => 'admin.template_setting.create', 'uses' => 'Backend\TemplateSettingController@create']);
    Route::post('/template_setting/store', ['as' => 'admin.template_setting.store', 'uses' => 'Backend\TemplateSettingController@store']);

});
