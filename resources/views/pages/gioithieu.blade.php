@extends('layout.index')
@section('title','Giới Thiệu')
@section('content')
<!-- Page Content -->
<div class="container">

    @include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
    @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới Thiệu</h2>
            	</div>



				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection

