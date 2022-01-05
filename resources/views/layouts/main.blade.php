

<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<meta charset="utf-8" />
		<title>R&M CMS</title>
		<meta name="description" content="User datatable listing" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<!--<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />-->
		<link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/favicon.png')}}">
		<script>

			function toggleUserOptions(){

				if($("#user-options-menu").hasClass("show")){
					$("#user-options-menu").removeClass("show")
				}else{
					$("#user-options-menu").addClass("show")
				}

			}

		</script>

		<style>

			.loader-cover-custom{
				position: fixed;
				left:0;
				right: 0;
				z-index: 99999999;
				background-color: rgba(0, 0, 0, 0.6);
				top: 0;
				bottom: 0;
			}

			.loader-custom {
				margin-top:45vh;
				margin-left: 45%;
				border: 16px solid #f3f3f3; /* Light grey */
				border-top: 16px solid #3498db; /* Blue */
				border-radius: 50%;
				width: 120px;
				height: 120px;
				animation: spin 2s linear infinite;
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}

			@media (min-width: 992px){
				.aside .aside-menu .menu-nav > .menu-item > .menu-link {
					width: 125px !important;
				}
			}
				

		</style>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<!--begin::Logo-->
			<a href="{{ url('/') }}">
				<img alt="Logo" class="w-45px logo-login" src="{{ asset('assets/img/mainLogo.png') }}"  />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Aside Mobile Toggle-->
				{{--<button class="btn p-0 burger-icon burger-icon-left" >
					<span></span>
				</button>--}}
				<!--end::Aside Mobile Toggle-->
				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn p-0 burger-icon ml-4" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<!--end::Header Menu Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<!--begin::Brand-->
					<div class="brand flex-column-auto" id="kt_brand">
						<!--begin::Logo-->
						<a href="{{ url('/') }}">

							<img alt="Logo" src="{{ asset('assets/img/mainLogo.png') }}" style="width: 100%;" />
						</a>
					</div>
					<!--end::Brand-->
					<!--begin::Aside Menu-->
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<!--begin::Menu Nav-->
							<ul class="menu-nav">

								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'banners') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon far fa-file-image"></i>
										<span class="menu-text">Banners</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('banners.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('banners.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="menu-item text-center @if(strpos(url()->current(), 'service-images') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('service-images.index') }}" class="menu-link text-center">
										<i class="menu-icon far fa-file-image"></i>
										<span class="menu-text">Imágenes de servicios</span>
									</a>
								</li>

								<li class="menu-item @if(strpos(url()->current(), 'orders') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('orders.index') }}" class="menu-link">
										<i class="menu-icon far fa-money-bill-alt"></i>
										<span class="menu-text">Ventas</span>
									</a>
								</li>

								<li class="menu-item @if(strpos(url()->current(), 'coupons') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('coupons.index') }}" class="menu-link">
										<i class="menu-icon fas fa-ticket-alt"></i>
										<span class="menu-text">Cupones</span>
									</a>
								</li>

								<li class="menu-item @if(strpos(url()->current(), 'clients') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('clients.index') }}" class="menu-link">
										<i class="menu-icon fas fa-users"></i>
										<span class="menu-text">Clientes</span>
									</a>
								</li>

								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'products') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-box-open"></i>
										<span class="menu-text">Productos</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('products.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('products.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'brands') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-gem"></i>
										<span class="menu-text">Marcas</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('brands.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('brands.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'categories') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-border-all"></i>
										<span class="menu-text">Categorías</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('categories.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('categories.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="menu-item @if(strpos(url()->current(), 'sizes') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('sizes.index') }}" class="menu-link">
										<i class="menu-icon fas fa-cog"></i>
										<span class="menu-text">Tallas</span>
									</a>
								</li>

								<li class="menu-item @if(strpos(url()->current(), 'colors') > -1) menu-item-active @endif" aria-haspopup="true">
									<a href="{{ route('colors.index') }}" class="menu-link">
										<i class="menu-icon fas fa-cog"></i>
										<span class="menu-text">Colores</span>
									</a>
								</li>

								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'blogs') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-book"></i>
										<span class="menu-text">Blog</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('blogs.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('blogs.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								
								<li class="menu-item menu-item-submenu @if(strpos(url()->current(), 'staffs') > -1) menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-user-tie"></i>
										<span class="menu-text">Personal</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Actions</span>
												</span>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('staffs.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Crear</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('staffs.list') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-line">
														<span></span>
													</i>
													<span class="menu-text">Listado</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								

								

								

								

								

								

								

								

								
								

							</ul>
							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div>
					<!--end::Aside Menu-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Header Menu Wrapper-->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<!--begin::Header Menu-->
								<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

								</div>
								<!--end::Header Menu-->
							</div>
							<!--end::Header Menu Wrapper-->
							<!--begin::Topbar-->
							<div class="topbar">

								<!--begin::User-->
								<div class="topbar-item">
									<div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle" onclick="toggleUserOptions()">
										<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hello,</span>
										<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ \Auth::user()->name }}</span>
										<!--<span class="symbol symbol-35 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold"></span>
										</span>-->
									</div>
									<!--begin::Dropdown-->
									<div id="user-options-menu" class="dropdown-menu" style="right: 0; float:right !important; left: unset; padding-left: 1rem; padding-bottom: 1rem;">
										<!--begin:Header-->

											<a href="{{ url('/logout') }}" class="btn btn-success btn-sm font-weight-bold font-size-sm mt-2">Cerrar sesión</a>

										<!--end:Nav-->
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						@yield("content")

					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark text-center" style="width: 100%;">
							<!---	<span class="text-muted font-weight-bold mr-2">2020 - 2021©</span>-->
								<a href="h#" target="_blank" class="text-dark-75 text-hover-primary">R&M Copyright</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Nav-->
							<!--end::Nav-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->



		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="{{ asset('assets/js/pages/custom/user/list-datatable.js') }}"></script>
		<script src="{{ asset('/js/app.js') }}"></script>

		@stack("scripts")

		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>
