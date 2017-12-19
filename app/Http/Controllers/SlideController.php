<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getThem(){
    	return view('admin.slide.them');
    }

    public function postThem(Request $request){
    	$this->validate($request,
    		[
				'Ten'     =>'required',
				'NoiDung' =>'required',
				'Hinh'    =>'image|mimes:png,jpg,jpeg,bmp'

    		],
    		[
				'Ten.required'     =>'Bạn chưa nhập tên slide',
				'NoiDung.required' =>'Bạn chưa nhập nội dung',
				'Hinh.image'       =>'Phải là định dạng hình',
				'Hinh.mimes'       =>'Hình của bạn phải là một trong các định dạng sau: png, jpg, jpeg, bmp'
    		]);

    	$slide = new Slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    		$slide->link = $request->link;

    	if($request->hasFile('Hinh')){
			$file = $request->file('Hinh');
			$name = $file->getClientOriginalName();
			$Hinh = str_random(4)."_".$name;
			while(file_exists("public/uploads/slide/".$Hinh)){
				$Hinh = str_random(4)."_".$Hinh;
			}
			$file->move("public/uploads/slide",$Hinh);
			$slide->Hinh = $Hinh;
		} else{
			$slide->Hinh = "";
		}
		$slide->save();
		return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id){
    	$this->validate($request,
    		[
				'Ten'     =>'required',
				'NoiDung' =>'required',
				'Hinh'    =>'image|mimes:png,jpg,jpeg,bmp'

    		],
    		[
				'Ten.required'     =>'Bạn chưa nhập tên slide',
				'NoiDung.required' =>'Bạn chưa nhập nội dung',
				'Hinh.image'       =>'Phải là định dạng hình',
				'Hinh.mimes'       =>'Hình của bạn phải là một trong các định dạng sau: png, jpg, jpeg, bmp'
    		]);

        $slide          = Slide::find($id);
        $slide->Ten     = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    		$slide->link = $request->link;

    	if($request->hasFile('Hinh')){
			$file = $request->file('Hinh');
			$name = $file->getClientOriginalName();
			$Hinh = str_random(4)."_".$name;
			while(file_exists("public/uploads/slide/".$Hinh)){
				$Hinh = str_random(4)."_".$Hinh;
			}
			$file->move("public/uploads/slide",$Hinh);
			unlink("public/uploads/slide/".$slide->Hinh);
			$slide->Hinh = $Hinh;
            } else{
            $slide->Hinh = "";
        }

		$slide->save();
		return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$slide = Slide::find($id);
    	$slide->delete();

    	return redirect('admin/slide/danh-sach')->with('thongbao','Xóa thành công');
    }
}
