<!doctype html>
<html lang="en" dir="ltr">
	
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="Numan">
		<!-- Title -->
		<title>{{$gs->title}}</title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
		<!-- Bootstrap -->
		<link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
		<!-- icofont -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">
		<!-- Sidemenu Css -->
		<link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
		
		<link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />		
    	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">
		<!-- Main Css -->
		<link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
		<style></style>
		@yield('styles')
	</head>

	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
							<div class="menu-toggle-button">
								<a class="nav-link" href="javascript:;" id="sidebarCollapse">
									<div class="my-toggl-icon">
											<span class="bar1"></span>
											<span class="bar2"></span>
											<span class="bar3"></span>
									</div>
								</a>
							</div>

							<div class="right-eliment">
								<ul class="list">

									<li class="bell-area">
										<a  class="dropdown-toggle-1" target="_blank" href="{{ route('front.index') }}">
											<i class="fas fa-globe-americas"></i>
										</a>
									</li>


									<li class="bell-area">
										<a id="notf_conv" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-envelope"></i>
											<span data-href="{{ route('conv-notf-count') }}" id="conv-notf-count">{{ App\Models\Notification::countConversation() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('conv-notf-show') }}" id="conv-notf-show">
										</div>
										</div>
									</li>


									<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-bell"></i>
											<span data-href="{{ route('notification-count') }}" id="order-notf-count">{{ App\Models\Notification::countNotification() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('order-notf-show') }}" id="order-notf-show">
											</div>
										</div>
									</li>

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
												<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
												<ul>
													<h5>{{ __('Welcome') }}!</h5>
													<li>
														<a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> {{ __('Edit Profile') }}</a>
													</li>
													<li>
														<a href="{{ route('admin.password') }}"><i class="fas fa-cog"></i> {{ __('Change Password') }}</a>
													</li>
													<li>
														<a href="{{ route('admin.logout') }}"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
													</li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">
							<li>
								<a href="{{ route('admin.dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ __('Dashboard') }}</a>
							</li>
							<!--<li>
								<a href="{{ route('admin-cat-index') }}" class=" wave-effect"><i class="fas fa-users-cog mr-2"></i>{{ __('Category') }}</a>
							</li>-->
							
							<li>
								<a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>{{ __('Campaign') }}</a>
								<ul class="collapse list-unstyled" id="order" data-parent="#accordion" >
                                   	<li>
                                    	<a href="{{ route('admin-campaign-index') }}"> {{ __('All Campaign') }}</a>
                                	</li>
                                    <li>
                                        <a href="{{route('admin-campaign-panding-index')}}"> {{ __('Pending Campaign') }}</a>
                                    </li>
									<li>
										<a href="{{ route('admin-all-donation') }}"><span>{{ __('All Donation') }}</span></a>
									</li>
								</ul>
							</li>
							@if(Auth::user()->role == 'administrator')
							<li>
								<a href="#menu3" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-user"></i>{{ __('Users') }}
								</a>
								<ul class="collapse list-unstyled" id="menu3" data-parent="#accordion">
									<li>
										<a href="{{ route('admin-user-index') }}"><span>{{ __('Users List') }}</span></a>
									</li>
									<li>
										<a href="{{ route('admin-withdraw-index') }}"><span>{{ __('Withdraws') }}</span></a>
									</li>
									
								</ul>
							</li>
							@endif

							<li>
								<a href="#blog" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-fw fa-newspaper"></i>{{ __('Blog') }}
								</a>
								<ul class="collapse list-unstyled" id="blog" data-parent="#accordion">
									<li>
										<a href="{{ route('admin-cblog-index') }}"><span>{{ __('Categories') }}</span></a>
									</li>
									<li>
										<a href="{{ route('admin-blog-index') }}"><span>{{ __('Posts') }}</span></a>
									</li>
								</ul>
							</li>

							
							@if(Auth::user()->role == 'administrator')
							
						
							<li>
								<a href="#homepage" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-edit"></i>{{ __('Home Page Settings') }}
								</a>
								<ul class="collapse list-unstyled" id="homepage" data-parent="#accordion">
                                   
                                    <li>
                                    	<a href="{{ route('admin-ps-callback.index') }}"><span>{{ __('Call Back Section') }}</span></a>
                                    </li>
                                    
								</ul>
							</li>
							
						
							
						
							<li>
								<a href="#emails" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-at"></i>{{ __('Email Settings') }}
								</a>
								<ul class="collapse list-unstyled" id="emails" data-parent="#accordion">
                                    <!--<li><a href="{{route('admin-mail-config')}}"><span>{{ __('Email Configurations') }}</span></a></li>-->  
                                    <li><a href="{{route('admin-group-show')}}"><span>{{ __('Group Email') }}</span></a></li>  
								</ul>
							</li>

							

							<li>
								<a href="#seoTools" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-wrench"></i>{{ __('SEO Tools') }}
								</a>
								<ul class="collapse list-unstyled" id="seoTools" data-parent="#accordion">
                                    <li>
                                    	<a href="{{ route('admin-seotool-analytics') }}"><span>{{ __('Google Analytics') }}</span></a>
                                    </li
                                    >
                                    <li>
                                    	<a href="{{ route('admin-seotool-keywords') }}"><span>{{ __('Website Meta Keywords') }}</span></a>
                                    </li>
								</ul>
							</li>-->

							


							<li>
								<a href="{{ route('admin.staff.index') }}" class=" wave-effect"><i class="fas fa-users mr-2"></i>{{ __('Manage Staffs') }}</a>
							</li>
							@endif

							

							<li>
								<a href="{{ route('admin-subs-index') }}" class=" wave-effect"><i class="fas fa-users-cog mr-2"></i>{{ __('Subscribers') }}</a>
							</li>
							
						</ul>
					</nav>
					<!-- Main Content Area Start -->
					@yield('content')
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>
	
			
		<script type="text/javascript">
				
		  var mainurl = "{{url('/')}}";
		   var admin_loader = {{ $gs->is_admin_loader }};
		   var lang  = {
				'new': '{{ __('ADD NEW') }}',
				'edit': '{{ __('EDIT') }}',
				'update': '{{ __('Status Updated Successfully.') }}',
				'sss': '{{ __('Success !') }}',
				'details': '{{ __('DETAILS') }}',
			};

		</script>

		<!-- Dashboard Core -->
		<script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
		<!-- Fullside-menu Js-->
		<script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
		<script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/plugin.js')}}"></script>
		<script src="{{asset('assets/admin/js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
		<script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/admin/js/notify.js') }}"></script>
        <script src="{{asset('assets/admin/js/jquery.canvasjs.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/load.js')}}"></script>
		<!-- Custom Js-->
		<!-- AJAX Js-->
		<script src="{{asset('assets/admin/js/custom.js')}}"></script>
		<script src="{{asset('assets/admin/js/myscript.js')}}"></script>
		@yield('scripts')

@if($gs->is_admin_loader == 0)
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
@endif

	</body>

</html>