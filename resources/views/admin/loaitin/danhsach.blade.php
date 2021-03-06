@extends('admin.layout.index')
@section('title','Danh sách loại tin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Loại Tin
                    <small>Danh Sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên Loại Tin</th>
                        <th>Tên Không Dấu</th>
                        <th>Thể Loại</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaitin as $lt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->Ten}}</td>
                            <td>{{$lt->TenKhongDau}}</td>
                            <td>{{$lt->theloai->Ten}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loai-tin/xoa/{{$lt->id}}" onclick="return xacnhanxoa('Bạn có chắc muốn xóa loại tin này?')"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loai-tin/sua/{{$lt->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection