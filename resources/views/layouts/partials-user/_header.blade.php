
<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">

						<!--begin::Container-->
						<div class="container d-flex align-items-stretch">

							<!--begin::Header Menu Wrapper-->
							<!--begin::Topbar-->
							<div class="topbar justify-content-between w-100">
								<div class="topbar-item">
									<a href="{{ route('home') }}" class="brand-logo m-auto">
										<img alt="Logo" height="35px" src="{{ asset('images/94nesha-areta.png') }}" />
									</a>
								</div>					
								<div class="topbar-item">
									@if (Auth::check())
										<a href="{{ route('admin.dashboard') }}" class="btn btn-success">
											Admin
										</a>									
									@else
										<a href="{{ route('admin.login') }}" class="btn btn-success">
											Login
										</a>
									@endif
								</div>					
							</div>

							<!--end::Header Menu Wrapper-->							

						</div>

						<!--end::Container-->
					</div>

					<!--end::Header-->