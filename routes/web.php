<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


route::get('/','PagesController@trangchu');
route::get('lien-he','PagesController@lienhe');
route::get('gioi-thieu','PagesController@gioithieu');

route::get('loai-tin/{id}/{TenKhongDau}.html','PagesController@loaitin');
route::get('tin-tuc/{id}/{TenKhongDau}.html','PagesController@tintuc');

route::get('dang-nhap','PagesController@getDangNhap');
route::post('dang-nhap','PagesController@postDangNhap');
route::get('dang-xuat','PagesController@getDangXuat');
route::get('nguoi-dung','PagesController@getNguoiDung');
route::post('nguoi-dung','PagesController@postNguoiDung');
route::get('dang-ky','PagesController@getDangKy');
route::post('dang-ky','PagesController@postDangKy');

route::any('tim-kiem','PagesController@timkiem');

route::post('comment/{id}','CommentController@postComment');


route::get('admin/dang-nhap','UserController@getDangnhapAdmin');
route::post('admin/dang-nhap','UserController@postDangnhapAdmin');
route::get('admin/dang-xuat','UserController@getDangxuatAdmin');

route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	route::group(['prefix'=>'the-loai'],function(){
		route::get('danh-sach','TheLoaiController@getDanhSach');

		route::get('sua/{id}','TheLoaiController@getSua');
		route::post('sua/{id}','TheLoaiController@postSua');

		route::get('them','TheLoaiController@getThem');
		route::post('them','TheLoaiController@postThem');

		route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	route::group(['prefix'=>'loai-tin'],function(){
		route::get('danh-sach','LoaiTinController@getDanhSach');

		route::get('sua/{id}','LoaiTinController@getSua');
		route::post('sua/{id}','LoaiTinController@postSua');

		route::get('them','LoaiTinController@getThem');
		route::post('them','LoaiTinController@postThem');

		route::get('xoa/{id}','LoaiTinController@getXoa');
	});

	route::group(['prefix'=>'slide'],function(){
		route::get('danh-sach','SlideController@getDanhSach');

		route::get('sua/{id}','SlideController@getSua');
		route::post('sua/{id}','SlideController@postSua'); 

		route::get('them','SlideController@getThem');
		route::post('them','SlideController@postThem');

		route::get('xoa/{id}','SlideController@getXoa');
	});

	route::group(['prefix'=>'tin-tuc'],function(){
		route::get('danh-sach','TinTucController@getDanhSach');

		route::get('sua/{id}','TinTucController@getSua');
		route::post('sua/{id}','TinTucController@postSua');

		route::get('them','TinTucController@getThem');
		route::post('them','TinTucController@postThem');

		route::get('xoa/{id}','TinTucController@getXoa');
	});

	route::group(['prefix'=>'comment'],function(){
		route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
	});

	route::group(['prefix'=>'user'],function(){
		route::get('danh-sach','UserController@getDanhSach');

		route::get('sua/{id}','UserController@getSua');
		route::post('sua/{id}','UserController@postSua');

		route::get('them','UserController@getThem');
		route::post('them','UserController@postThem');

		route::get('xoa/{id}','UserController@getXoa');
	});

	route::group(['prefix'=>'ajax'],function(){
		route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});
});

route::get('admin',function(){
	return view('admin.layout.index');
});


