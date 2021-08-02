
<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

			<!--begin::Logo-->
			{{-- <a href="index.html">
				<img alt="Logo" src="{{ asset('assets/media/logos/logo-dark.png') }}" />
			</a> --}}

			<!--end::Logo-->

			<!--begin::Toolbar-->
			<div class="d-flex align-items-center justify-content-between w-100">

				<!--end::Aside Mobile Toggle-->

				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>

				<!--end::Header Menu Mobile Toggle-->


				<!--end::Topbar Mobile Toggle-->
				<div class="topbar-item">
					<a href="{{ route('home') }}" class="brand-logo m-auto">
						<img alt="Logo" height="35px" src="{{ asset('images/94nesha-areta.png') }}" />
					</a>					
				</div>
			</div>

			<!--end::Toolbar-->
		</div>

		<!--end::Header Mobile-->