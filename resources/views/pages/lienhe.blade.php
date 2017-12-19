@extends('layout.index')
@section('title','Liên Hệ')
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
            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
            	</div>

            	<div class="panel-body">
            		<!-- item -->
                    <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
				    
                    <div class="break"></div>
				   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                    <p><i>Số 29A, ngõ 124 Vĩnh Tuy, Hai Bà Trưng, Hà Nội</i> </p>   

                    <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                    <p><i>Masterhuy@gmail.com </i></p>

                    <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                    <p><i>(+84) 975766675</i> </p>



                    <br><br>
                    <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                    <div class="break"></div><br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14898.905013137986!2d105.86206641290292!3d21.0036076158688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd5e3ff295ea5edb9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaW5oIGRvYW5oIHbDoCBDw7RuZyBuZ2jhu4cgSMOgIE7hu5lp!5e0!3m2!1svi!2s!4v1488194818357" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection

