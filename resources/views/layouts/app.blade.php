<!DOCTYPE html>
<html>

<!-- header include -->
@section('header')
	@include('layouts.partials.header')
@show

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
	@include('layouts.partials.mainheader')

    @include('layouts.partials.sidebar')

    <div class="content-wrapper">
    <!-- Main content -->
	    <section class="content mt-2" id="app">
	    	@yield('main-content')
	    </section>
    <!-- /.content -->
	</div>
</div>
<!-- /.content-wrapper -->

<!-- footer include -->
@include('layouts.partials.footer')

</body>
</html>