<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<title>Mstore - Online Shop Mobile Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1  maximum-scale=1 user-scalable=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="HandheldFriendly" content="True">

	<link rel="stylesheet" href="css/materialize.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/owl.theme.css">
	<link rel="stylesheet" href="css/owl.transitions.css">
	<link rel="stylesheet" href="css/fakeLoader.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link rel="shortcut icon" href="img/favicon.png">

	<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>

</head>
<body>

	<!-- navbar top -->
	<div class="navbar-top">
		<!-- site brand	 -->
		<div class="site-brand">
			<a href="/"><h1>Mstore</h1></a>
		</div>
		<!-- end site brand	 -->
		<div class="side-nav-panel-right">
			<a href="#" data-activates="slide-out-right" class="side-nav-left"><i class="fa fa-user"></i></a>
		</div>
	</div>
	<!-- end navbar top -->

	<!-- side nav right-->
	<div class="side-nav-panel-right">
		<ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
			<li class="profil">
				<img src="img/profile.jpg" alt="">
				<h2>John Doe</h2>
			</li>
			<li><a href="javascript:;"><i class="fa fa-cog"></i>Settings</a></li>
			<li><a href="lists"><i class="fa fa-user"></i>About Us</a></li>
			<li><a href="javascript:;"><i class="fa fa-envelope-o"></i>Contact Us</a></li>
			<li><a href="log"><i class="fa fa-sign-in"></i>Login</a></li>
			<li><a href="reg"><i class="fa fa-user-plus"></i>Register</a></li>
		</ul>
	</div>
	<!-- end side nav right-->

	<!-- navbar bottom -->
	<div class="navbar-bottom">
		<div class="row">
			<div class="col s2">
				<a href="/"><i class="fa fa-home"></i></a>
			</div>
			<div class="col s2">
				<a href="wish/wishList"><i class="fa fa-heart"></i></a>
			</div>
			<div class="col s4">
				<div class="bar-center">
					<a href="cartlist" id="cart-menu"><i class="fa fa-shopping-basket"></i></a>
					<span>2</span>
				</div>
			</div>
			<div class="col s2">
				<a href="lists"><i class="fa fa-envelope-o"></i></a>
			</div>
			<div class="col s2">
				<a href="#animatedModal2" id="nav-menu"><i class="fa fa-bars"></i></a>
			</div>
		</div>
	</div>
	<!-- end navbar bottom -->

	<!-- menu -->
	<div class="menus" id="animatedModal2">
		<div class="close-animatedModal2 close-icon">
			<i class="fa fa-close"></i>
		</div>
		<div class="modal-content">
			<div class="container">
				<div class="row">
					<div class="col s4">
						<a href="/" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-home"></i>
								</div>
								Home
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="product/productList" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-bars"></i>
								</div>
								Product List
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-eye"></i>
								</div>
								Single Shop
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="wish/wishList" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-heart"></i>
								</div>
								Wishlist
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="cartlist" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-shopping-cart"></i>
								</div>
								Cart
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-credit-card"></i>
								</div>
								Checkout
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-bold"></i>
								</div>
								Blog
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-file-text-o"></i>
								</div>
								Blog Single
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-hourglass-half"></i>
								</div>
								404
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-support"></i>
								</div>
								Testimonial
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="lists" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-user"></i>
								</div>
								About Us
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="cartlist" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-envelope-o"></i>
								</div>
								Contact
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="javascript:;" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-cog"></i>
								</div>
								Settings
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="log" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-sign-in"></i>
								</div>
								Login
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="reg" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-user-plus"></i>
								</div>
								Register
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end menu -->

	<!-- cart menu -->
	<div class="menus" id="animatedModal">
		<div class="close-animatedModal close-icon">
			<i class="fa fa-close"></i>
		</div>
		<div class="modal-content">
			<div class="cart-menu">
				<div class="container">
					<div class="content">
						<div class="cart-1">
							<div class="row">
								<div class="col s5">
									<img src="img/cart-menu1.png" alt="">
								</div>
								<div class="col s7">
									<h5><a href="">Fashion Men's</a></h5>
								</div>
							</div>
							<div class="row quantity">
								<div class="col s5">
									<h5>Quantity</h5>
								</div>
								<div class="col s7">
									<input value="1" type="text">
								</div>
							</div>
							<div class="row">
								<div class="col s5">
									<h5>Price</h5>
								</div>
								<div class="col s7">
									<h5>$20</h5>
								</div>
							</div>
							<div class="row">
								<div class="col s5">
									<h5>Action</h5>
								</div>
								<div class="col s7">
									<div class="action"><i class="fa fa-trash"></i></div>
								</div>
							</div>
						</div>
						<div class="divider"></div>
						<div class="cart-2">
							<div class="row">
								<div class="col s5">
									<img src="img/cart-menu2.png" alt="">
								</div>
								<div class="col s7">
									<h5><a href="">Fashion Men's</a></h5>
								</div>
							</div>
							<div class="row quantity">
								<div class="col s5">
									<h5>Quantity</h5>
								</div>
								<div class="col s7">
									<input value="1" type="text">
								</div>
							</div>
							<div class="row">
								<div class="col s5">
									<h5>Price</h5>
								</div>
								<div class="col s7">
									<h5>$20</h5>
								</div>
							</div>
							<div class="row">
								<div class="col s5">
									<h5>Action</h5>
								</div>
								<div class="col s7">
									<div class="action"><i class="fa fa-trash"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="total">
						<div class="row">
							<div class="col s7">
								<h5>Fashion Men's</h5>
							</div>
							<div class="col s5">
								<h5>$21.00</h5>
							</div>
						</div>
						<div class="row">
							<div class="col s7">
								<h5>Fashion Men's</h5>
							</div>
							<div class="col s5">
								<h5>$21.00</h5>
							</div>
						</div>
						<div class="row">
							<div class="col s7">
								<h6>Total</h6>
							</div>
							<div class="col s5">
								<h6>$41.00</h6>
							</div>
						</div>
					</div>
					<button class="btn button-default">Process to Checkout</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart menu -->

	
	<!-- register -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
			<div class="register">
				<div class="row">
					<form class="col s12">
						<div class="input-field">
							<input type="text" class="validate" name="user_name" id="user_name" placeholder="NAME" required>
						</div>
						<div class="input-field">
							<input type="email" placeholder="EMAIL" name="user_email" id="user_email" class="validate" required>
						</div>
						<div class="input-field">
							<s class="phone"></s><input id="userMobile" name="user_tel" id="user_tel" maxlength="11"  type="number" placeholder="tel" value="" />
						</div>
						<div class="input-field">
							<input type="password" placeholder="PASSWORD" name="user_pass" id="user_pass" class="validate" required>
						</div>
						<div class="input-field">
							<s class="phone"></s><input id="user_code" name="user_code" style="width: 67%" maxlength="11"  type="number" placeholder="请输入验证码" value="" />
							<button type="button" class="layui-btn layui-btn-lg layui-btn-radius layui-btn-normal" id="dateBtn1">获取验证码</button>
						</div>
						<div class="btn button-default" id="reg">REGISTER</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end register -->

	<!-- loader -->
	<div id="fakeLoader"></div>
	<!-- end loader -->
	
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="about-us-foot">
				<h6>Mstore</h6>
				<p>is a lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
			</div>
			<div class="social-media">
				<a href=""><i class="fa fa-facebook"></i></a>
				<a href=""><i class="fa fa-twitter"></i></a>
				<a href=""><i class="fa fa-google"></i></a>
				<a href=""><i class="fa fa-linkedin"></i></a>
				<a href=""><i class="fa fa-instagram"></i></a>
			</div>
			<div class="copyright">
				<span>© 2017 All Right Reserved</span>
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/fakeLoader.min.js"></script>
	<script src="js/animatedModal.min.js"></script>
	<script src="js/main.js"></script>
	<script src="layui/layui.js"></script>
	<script type="text/javascript"></script>
	<script src="js/leftTime.min.js"></script>
	<script>
        $(function(){
            layui.use(['form','layer'], function(){
                var form = layui.form();
                var layer=layui.layer;
                $('#reg').click(function(){
                    if($('#user_name').val()==''){
                        layer.msg('请输入您的用户名！');
                    }else if($('#user_email').val()==''){
                        layer.msg('请输入您的邮箱!');
					}else if($('#user_pass').val()==''){
                        layer.msg('请输入您的密码!');
                    }else{
                        var url = "register";
                        var user_name = $('#user_name').val();
                        var user_email = $('#user_email').val();
                        var user_tel = $('#userMobile').val();
                        var user_code = $('#user_code').val();
                        var user_pass = $('#user_pass').val();
                        $.ajax({
                            data   : {user_name:user_name,user_email:user_email,user_pass:user_pass,user_tel:user_tel,user_code:user_code},
                            url : url,
                            type:'POST',//HTTP请求类
                            success:function(msg){
                                console.log(msg);
                                if(msg.status==1){
//                                     layer.msg(msg.msg);
//                                     location.href='reg';
                                    layer.open({
                                        type:0,
                                        content:'注册成功',
                                        btn:['继续注册','马上去登陆'],
                                        yes:function(index,layero){
                                            location.href="reg";
                                            return true;
                                        },
                                        btn2:function(){
                                            location.href="log";
                                            return true;
                                        }
                                    })
                                }else if(msg.status==3){
                                    layer.msg(msg.msg);
//                                     location.href='reg';
								}else if(msg.status==5){
                                    layer.msg(msg.msg);
//                                     location.href='reg';
                                }else if(msg.status==4){
                                    layer.msg(msg.msg);
//                                     location.href='reg';
                                }else{
                                    layer.msg(msg.msg);
//                                    location.href='reg';
                                }
                            },
                        });
                    }
                });
                $('#user_pass').blur(function(){
                    reg=/^[0-9a-zA-Z]{6,16}$/;
                    var that = $(this);
                    if( that.val()==""|| that.val()=="6-16位数字或字母组成")
                    {
                        layer.msg('请设置您的密码！');
                    }else if(!reg.test($(".pwd").val())){
                        layer.msg('请输入6-16位数字或字母组成的密码!');
                    }
                })
            })
        })

        $(function(){
            //60秒倒计时
            $("#dateBtn1").on("click",function(){
                var _this=$(this);
                if(!$(this).hasClass("on")){
                    var data = {};
                    var url = "getcode";
                    tel = $("#userMobile").val();
                    data.tel = tel;
                    $.ajax({
                        type : "post",
                        data : data,
                        url : url,
                        dataType : "json",
                        success:function(msg){

                        }
                    })
                    $.leftTime(60,function(d){
                        if(d.status){
                            _this.addClass("on");
                            _this.html((d.s=="00"?"60":d.s)+"秒后重新获取");
                        }else{
                            _this.removeClass("on");
                            _this.html("获取验证码");
                        }
                    });
                }
            });
        });
	</script>
</body>
</html>