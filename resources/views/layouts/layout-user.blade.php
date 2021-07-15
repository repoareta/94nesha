<!DOCTYPE html>
<html lang="en">

	<!--begin::Head-->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>94nesha</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Styles-->
		@include('layouts.styles')
	</head>

	<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed page-loading">

		<!--[html-partial:include:{"file":"partials/_page-loader.html"}]/-->
		@include('layouts.partials-user._page-loader')
		<!--[html-partial:include:{"file":"layout.html"}]/-->
		<!--begin::Main-->

		<!--[html-partial:include:{"file":"partials/_header-mobile.html"}]/-->
		@include('layouts.partials-user._header-mobile')
		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<!--[html-partial:include:{"file":"partials/_header.html"}]/-->
					@include('layouts.partials-user._header')
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						@yield('content')
					</div>

					<!--end::Content-->

					<!--[html-partial:include:{"file":"partials/_footer.html"}]/-->
					@include('layouts.partials-user._footer')
				</div>

				<!--end::Wrapper-->
			</div>

			<!--end::Page-->
		</div>

		<!--end::Main-->

		<!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->
		@include('layouts.partials-user._extras.scrolltop')
		
	</body>
	
	<!--end::Body-->
	<!--begin::Scripts-->
	@include('layouts.scripts')
</html>