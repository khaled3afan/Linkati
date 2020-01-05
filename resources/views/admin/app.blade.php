<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/adminpro/images/favicon.ico">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Admin</title>

	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="/adminpro/plugins/morris/morris.css">

	<!-- App css -->
	<link href="/adminpro/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/core.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/components.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/icons.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/pages.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/menu.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/css/responsive.css" rel="stylesheet" type="text/css"/>

	<!-- Plugins -->
	<link href="/adminpro/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet"/>
	<link href="/adminpro/plugins/jQuery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css"/>
	<link href="/adminpro/plugins/jQuery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"
	      type="text/css"/>
	<link href="/adminpro/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>

	<link href="/adminpro/css/liliom.css" rel="stylesheet"/>

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<script src="/adminpro/js/modernizr.min.js"></script>

</head>
<body class="fixed-left admin @yield('body_class')">
<!-- Begin page -->
<div id="wrapper">
@include('admin.partials.header')
<!-- ========== Left Sidebar Start ========== -->
@include('admin.partials.sidebar')

<!-- ========== Start right Content here ========== -->
	<div class="content-page">
		<!-- Start content -->
		<div class="content">
			<div class="container">
				@yield('content')
			</div><!-- container -->
		</div><!-- content -->
		@include('admin.partials.footer')
	</div>
	<!-- ========== End Right content here ========== -->

	@include('admin.partials.notices')
</div>
<!-- END wrapper -->

@yield('modal')

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="/adminpro/js/jquery.min.js"></script>
<script src="/adminpro/js/bootstrap-rtl.min.js"></script>
<script src="/adminpro/js/detect.js"></script>
<script src="/adminpro/js/fastclick.js"></script>
<script src="/adminpro/js/jquery.blockUI.js"></script>
<script src="/adminpro/js/waves.js"></script>
<script src="/adminpro/js/jquery.slimscroll.js"></script>
<script src="/adminpro/js/jquery.scrollTo.min.js"></script>
<script src="/adminpro/plugins/tinymce/tinymce.min.js"></script>
<script src="/adminpro/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/adminpro/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="/adminpro/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="/adminpro/plugins/jQuery.filer/js/jquery.filer.js"></script>
{{-- <script src="/adminpro/js/jquery.nestable-rtl.js"></script> --}}
<script src="/adminpro/js/jquery-sortable.js"></script>
{{-- <script type="text/javascript" src="/adminpro/plugins/multiselect/js/jquery.multi-select.js"></script> --}}
{{-- <script type="text/javascript" src="/adminpro/plugins/jquery-quicksearch/jquery.quicksearch.js"></script> --}}
<script type="text/javascript" src="/adminpro/js/jquery-cloneya.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="/adminpro/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="/adminpro/plugins/jquery-knob/jquery.knob.js"></script>

<!--Morris Chart-->
{{-- <script src="/adminpro/plugins/morris/morris.min.js"></script> --}}
{{-- <script src="/adminpro/plugins/raphael/raphael-min.js"></script> --}}

<!-- Dashboard init -->
{{-- <script src="/adminpro/pages/jquery.dashboard.js"></script> --}}

<!-- App js -->
<script src="/adminpro/js/jquery.core.js"></script>
<script src="/adminpro/js/jquery.app.js"></script>

<script src="/adminpro/js/liliom.js" type="text/javascript"></script>

@yield('scripts')
@if(session()->has('success'))
	<script type="text/javascript">
        swal({
            title: '@lang("admin.great")',
            text: '{{ session('success') }}',
            type: 'success',
            confirmButtonText: '@lang("admin.close")'
        });
	</script>
@endif
@if(session()->has('error'))
	<script type="text/javascript">
        swal({
            title: '@lang("admin.error")',
            text: '{{ session('error') }}',
            type: 'error',
            confirmButtonText: '@lang("admin.close")'
        });
	</script>
@endif

<!-- Google Code for Yawmme Conversion Page -->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 934908808;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "HUNyCPbr0XUQiKfmvQM";
    var google_remarketing_only = false;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
	<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt=""
		     src="//www.googleadservices.com/pagead/conversion/934908808/?label=HUNyCPbr0XUQiKfmvQM&amp;guid=ON&amp;script=0"/>
	</div>
</noscript>
</body>
</html>
