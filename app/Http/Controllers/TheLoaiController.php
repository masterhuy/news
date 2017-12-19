<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
            ],
            [
                'Ten.required' =>'Vui lòng nhập tên thể loại',
                'Ten.min'      =>'Tên thể loại phải tối thiểu 3 ký tự',
                'Ten.max'      =>'Tên thể loại chỉ tối đa 100 ký tự',
                'Ten.unique'   =>'Tên thể loại đã tồn tại'
            ]);
        $theloai->Ten         = $request->Ten;
        $theloai->TenKhongDau = str_slug($request->Ten,"-");
        $theloai->save();
        return redirect('admin/the-loai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getThem(){
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
    		],
    		[
                'Ten.required' =>'Vui lòng nhập tên thể loại',
                'Ten.min'      =>'Tên thể loại phải tối thiểu 3 ký tự',
                'Ten.max'      =>'Tên thể loại chỉ tối đa 100 ký tự',
                'Ten.unique'   =>'Tên thể loại đã tồn tại'
    		]);
        $theloai              = new TheLoai;
        $theloai->Ten         = $request->Ten;
        $theloai->TenKhongDau = str_slug($request ->Ten,"-");
    	$theloai->save();
    	return redirect('admin/the-loai/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/the-loai/danh-sach')->with('thongbao','Xóa thành công');
    }
}
