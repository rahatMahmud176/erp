<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/skote/layouts/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 15:06:42 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Website | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
       @include('back-end.includes.styles')

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">
            @if (Session::get('userId'))
                @include('back-end.includes.nav')
                @include('back-end.includes.sidebar')
            @endif
           
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
        <div class="main-content">
            @yield('mainContent')
        @if (Session::get('userId'))
            @include('back-end.includes.footer')
        @endif
        </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
 

        <!-- Right bar overlay-->
        

        <!-- JAVASCRIPT -->
        @include('back-end.includes.scripts')
    </body>


<!-- Mirrored from themesbrand.com/skote/layouts/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 15:07:20 GMT -->
</html>