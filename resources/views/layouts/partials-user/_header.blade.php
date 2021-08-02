
<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">

						<!--begin::Container-->
						<div class="container d-flex align-items-stretch">
							
							<!--begin::Topbar-->
							<div class="topbar justify-content-between w-100">
								<div class="topbar-item">
									<a href="{{ route('home') }}" class="brand-logo m-auto">
										<img alt="Logo" height="35px" src="{{ asset('images/94nesha-areta.png') }}" />
									</a>
								</div>
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
	
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item menu-item-submenu">
												<a href="{{ route('admin.report.formulir.pasien_covid.') }}" class="menu-link">
													<span class="menu-text">Data Pasien</span>
													<i class="menu-arrow"></i>
												</a>
											</li>
											<li class="menu-item menu-item-submenu">
												<a href="{{ route('admin.report.formulir.penyintas_covid.') }}" class="menu-link">
													<span class="menu-text">Data Penyintas</span>
													<i class="menu-arrow"></i>
												</a>
											</li>
											<li class="menu-item menu-item-submenu">
												@if (Auth::check())
													<div class="menu-link">
														<a href="{{ route('admin.dashboard') }}" class="btn btn-success">
															Admin
														</a>
													</div>
												@else
													<div class="menu-link">
														<a href="{{ route('admin.login') }}" class="btn btn-success">
															Login
														</a>
													</div>
												@endif
											</li>
										</ul>
	
										<!--end::Header Nav-->
									</div>	
									<!--end::Header Menu-->										
								</div>
							</div>

							<!--end::Header Menu Wrapper-->							

						</div>

						<!--end::Container-->
					</div>

					<!--end::Header-->