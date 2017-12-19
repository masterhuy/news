<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getSua($id){
       $loaitin = LoaiTin::find($id);
       $theloai = TheLoai::all();
       return view('admin.loaitin.sua',['loaitin'=>$loaitin],['theloai'=>$theloai]);
    }

    public function postSua(request $request,$id){
        $this->validate($request,
            [
                'Ten'     =>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai' =>'required'
            ],
            [
                'Ten.required'     =>'Vui lòng nhập tên loại tin',
                'Ten.unique'       =>'Loại tin đã tồn tại',
                'Ten.min'          =>'Tên loại tin phải tối thiểu 3 ký tự',
                'Ten.max'          =>'Tên loại tin chỉ được tối đa 100 ký tự',
                'TheLoai.required' =>'Bạn chưa chọn thể loại'
            ]);

        $loaitin              = LoaiTin::find($id);
        $loaitin->Ten         = $request->Ten;
        $loaitin->TenKhongDau = str_slug($request->Ten,"-");
        $loaitin->idTheLoai   = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loai-tin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getThem(){
        $theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request){
    	$this->validate($request,
            [
                'Ten'     =>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai' =>'required'
            ],
            [
                'Ten.required'     =>'Vui lòng nhập tên loại tin',
                'Ten.unique'       =>'Loại tin đã tồn tại',
                'Ten.min'          =>'Tên loại tin phải tối thiểu 3 ký tự',
                'Ten.max'          =>'Tên loại tin chỉ được tối đa 100 ký tự',
                'TheLoai.required' =>'Bạn chưa chọn thể loại'
            ]);

        $loaitin              = new LoaiTin;
        $loaitin->Ten         = $request->Ten;
        $loaitin->TenKhongDau = str_slug($request->Ten,"-");
        $loaitin->idTheLoai   = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loai-tin/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loai-tin/danh-sach')->with('thongbao','Xóa thành công');
    }
}
