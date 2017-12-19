<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\TinTuc;


class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc){
    	$comment = Comment::find($id);
    	$comment->delete();

    	return redirect('admin/tin-tuc/sua/'.$idTinTuc)->with('thongbao','Xóa thành công');
    }

    public function postComment(Request $request,$id){
		$idTinTuc          = $id;
		$tintuc            = TinTuc::find($id);
		$comment           = new Comment;
		$comment->idTinTuc = $idTinTuc;
		$comment->idUser   = Auth::user()->id;
		$comment->NoiDung  = $request->NoiDung;
    	$comment->save();

    	return redirect('tin-tuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','Bình luận thành công');
    }
}
