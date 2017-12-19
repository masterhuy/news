<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;

class TinTucController extends Controller
{
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }

    public function postThem(Request $request){
    	$this->validate($request,
    		[
				'LoaiTin' =>'required',
				'TieuDe'  =>'required|unique:TinTuc,TieuDe|min:3',
				'TomTat'  =>'required',
				'NoiDung' =>'required',
				'Hinh'    =>'image|mimes:png,jpg,jpeg,bmp'
    		],
    		[
				'LoaiTin.required' =>'Bạn chưa chọn loại tin',
				'TieuDe.required'  =>'Bạn chưa nhập tiêu đề',
				'TieuDe.unique'    =>'Tiêu đề đã tồn tại',
				'TieuDe.min'       =>'Tiêu đề phải tối thiểu 3 ký tự',
				'TomTat.required'  =>'Bạn chưa nhập tóm tắt',
				'NoiDung.required' =>'Bạn chưa nhập nội dung',
				'Hinh.image'       =>'Phải là định dạng hình',
				'Hinh.mimes'       =>'Hình của bạn phải là một trong các định dạng sau: png, jpg, jpeg, bmp'
    		]);
		$tintuc                 = new TinTuc;
		$tintuc->TieuDe         = $request->TieuDe;
		$tintuc->TieuDeKhongDau = str_slug($request->TieuDe);
		$tintuc->idLoaiTin      = $request->LoaiTin;
		$tintuc->TomTat         = $request->TomTat;
		$tintuc->NoiDung        = $request->NoiDung;
		$tintuc->SoLuotXem      = 0;

		if($request->hasFile('Hinh')){
			$file = $request->file('Hinh');
			$name = $file->getClientOriginalName();
			$Hinh = str_random(4)."_".$name;
			while(file_exists("public/uploads/tintuc/".$Hinh)){
				$Hinh = str_random(4)."_".$Hinh;
			}
			$file->move("public/uploads/tintuc",$Hinh);
			$tintuc->Hinh = $Hinh;
		} else{
			$tintuc->Hinh = "";
		}
		$tintuc->save();
		return redirect('admin/tin-tuc/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
    	return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request,$id){
    	$tintuc = TinTuc::find($id);
    	$this->validate($request,
    		[
				'LoaiTin' =>'required',
				'TieuDe'  =>'required',
				'TomTat'  =>'required',
				'NoiDung' =>'required',
				'Hinh'    =>'image|mimes:png,jpg,jpeg,bmp'
    		],
    		[
				'LoaiTin.required' =>'Bạn chưa chọn loại tin',
				'TieuDe.required'  =>'Bạn chưa nhập tiêu đề',
				'TieuDe.min'       =>'Tiêu đề phải tối thiểu 3 ký tự',
				'TomTat.required'  =>'Bạn chưa nhập tóm tắt',
				'NoiDung.required' =>'Bạn chưa nhập nội dung',
				'Hinh.image'       =>'Tệp phải là định dạng hình',
				'Hinh.mimes'       =>'Hình của bạn phải là một trong các định dạng sau: png, jpg, jpeg, bmp'
    		]);
		
		$tintuc->TieuDe         = $request->TieuDe;
		$tintuc->TieuDeKhongDau = str_slug($request->TieuDe);
		$tintuc->idLoaiTin      = $request->LoaiTin;
		$tintuc->TomTat         = $request->TomTat;
		$tintuc->NoiDung        = $request->NoiDung;
		$tintuc->NoiBat         = $request->NoiBat;

		if($request->hasFile('Hinh')){
			$file = $request->file('Hinh');
			$name = $file->getClientOriginalName();
			$Hinh = str_random(4)."_".$name;
			while(file_exists("public/uploads/tintuc/".$Hinh)){
				$Hinh = str_random(4)."_".$Hinh;
			}
			$file->move("public/uploads/tintuc",$Hinh);
			unlink("public/uploads/tintuc/".$tintuc->Hinh);
			$tintuc->Hinh = $Hinh;
		}
		$tintuc->save();
		return redirect('admin/tin-tuc/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tin-tuc/danh-sach')->with('thongbao','Xóa thành công');
    }
}
