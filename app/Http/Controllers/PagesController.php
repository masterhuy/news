<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

class PagesController extends Controller
{
	function __construct(){
        $theloai = TheLoai::all();
        $slide   = Slide::all();
		view()->share('theloai',$theloai);
        view()->share('slide',$slide);

        if(Auth::check()){
            view()->share('nguoidung',Auth::user());
        }
	}

    function trangchu(){	
    	return view('pages.trangchu');
    }

    function lienhe(){
    	return view('pages.lienhe');
    }

    function gioithieu(){
        return view('pages.gioithieu');
    }

    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc  = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
        $tintuc      = TinTuc::find($id);
        $tinnoibat   = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangNhap(){
        return view('pages.dangnhap');
    }

    function postDangNhap(Request $request){
        $this->validate($request,
            [
                'email'    =>'required',
                'password' =>'required|min:5|max:20',
            ],
            [
                'email.required'    =>'Bạn chưa nhập email',
                'password.required' =>'Bạn chưa nhập mật khẩu',
                'password.min'      =>'Mật khẩu phải tối thiểu 5 ký tự',
                'password.max'      =>'Mật khẩu chỉ được tối đa 20 ký tự'
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('');
        }else{
            return redirect('dang-nhap')->with('thongbao','Tài khoản hoặc mật khẩu không đúng!');
        }
    }

    function getDangXuat(){
        Auth::logout();
        return redirect('/');
    }

    function getNguoiDung(){
        $user = Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }

    function postNguoiDung(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3|max:20',
            ],
            [
                'name.required' =>'Bạn chưa nhập tên người dùng',
                'name.min'      =>'Tên người dùng phải tối thiểu 3 ký tự',
            ]);

        $user        = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;
        
        if($request->changePassword == "on"){
            $this->validate($request,
            [
                'password'      =>'required|min:5|max:20',
                'passwordAgain' =>'required|same:password'
            ],
            [
                'nam.max'                =>'Tên người dùng chỉ được tối đa 20 ký tự',
                'email.required'         =>'Bạn chưa nhập email',
                'email.unique'           =>'Email đã tồn tại',
                'email.email'            =>'Bạn chưa nhập đúng định dạng email',
                'password.required'      =>'Bạn chưa nhập password',
                'password.min'           =>'Mật khẩu tối thiểu 5 ký tự',
                'password.max'           =>'Mật khẩu chỉ được tối đa 20 ký tự',
                'passwordAgain.required' =>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'     =>'Mật khẩu nhập lại không khớp'
            ]);
            $user->password = bcrypt($request->password);
        } 
        $user->save();

        return redirect('nguoi-dung')->with('thongbao','Sửa thành công');
    }

    public function getDangKy(){
        return view('pages.dangky');
    }

    public function postDangKy(request $request){
        $this->validate($request,
            [
                'name'          =>'required|min:3|max:20',
                'email'         =>'required|email|unique:users,email',
                'password'      =>'required|min:5|max:20',
                'passwordAgain' =>'required|same:password'
            ],
            [
                'name.required'          =>'Bạn chưa nhập tên người dùng',
                'name.min'               =>'Tên người dùng phải tối thiểu 3 ký tự',
                'nam.max'                =>'Tên người dùng chỉ được tối đa 20 ký tự',
                'email.required'         =>'Bạn chưa nhập email',
                'email.unique'           =>'Email đã tồn tại',
                'email.email'            =>'Bạn chưa nhập đúng định dạng email',
                'password.required'      =>'Bạn chưa nhập password',
                'password.min'           =>'Mật khẩu tối thiểu 5 ký tự',
                'password.max'           =>'Mật khẩu chỉ được tối đa 20 ký tự',
                'passwordAgain.required' =>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'     =>'Mật khẩu nhập lại không khớp'
            ]);

        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen    = 0;
        $user->save();

        return redirect('dang-ky')->with('thongbao','Đăng ký thành công');
    }

    function timkiem(request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(10)->paginate(5)->appends(['tukhoa'=>$tukhoa]);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
