@extends('admin.layout.index')
@section('title','Sửa slide')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>{{$slide->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>  
                @endif

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên slide..." value="{{$slide->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="3">{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" placeholder="Nhập link..." value="{{$slide->link}}" />
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <p><img width="400px" src="public/uploads/slide/{{$slide->Hinh}}" alt=""></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm Mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
</div>
<!-- /#page-wrapper -->
@endsection