<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\TheLoai;

class UserController extends Controller
{
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $request){
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
        $user->quyen    = $request->quyen;
    	$user->save();

    	return redirect('admin/user/them')->with('thongbao','Thêm user thành công');
    }

    public function getSua($id){
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request,$id){
    	$this->validate($request,
    		[
    			'name'=>'required|min:3|max:20',
    		],
    		[
				'name.required' =>'Bạn chưa nhập tên người dùng',
				'name.min'      =>'Tên người dùng phải tối thiểu 3 ký tự',
    		]);

		$user        = User::find($id);
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
    	
    	
    	$user->quyen = $request->quyen;
    	$user->save();

    	return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$user = User::find($id);
    	$user->delete();

    	return redirect('admin/user/danh-sach')->with('thongbao','Xóa thành công');
    }

    public function getDangnhapAdmin(){
        if(!Auth::check()){ 
    		return view('admin.login');
        } else {
            return redirect('admin/the-loai/danh-sach');
        }
    }

    public function postDangnhapAdmin(Request $request){
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
    		return redirect('admin/the-loai/danh-sach');
    	}else{
    		return redirect('admin/dang-nhap')->with('thongbao','Tài khoản hoặc mật khẩu không đúng!');
    	}
    }

    public function getDangxuatAdmin(){
    	Auth::logout();
    	return redirect('admin/dang-nhap');
    }
}
