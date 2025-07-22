<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$title}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico">

    <!-- Core css -->
    <link href="{{ asset('assets_dashboard/css/app.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="layout">
        <div class="vertical-layout">
            <!-- Header START -->
            @include('user_dashboard.components.header')
            <!-- Header END -->

            <!-- Side Nav START -->
           @include('user_dashboard.components.navbar')
            <!-- Side Nav END -->

            <!-- Content START -->
            <div class="content">
                <div class="main">
                  @yield('content')
                </div>
                <!-- Footer START -->
                <div class="footer">
                    <div class="footer-content">
                        <p class="mb-0">Copyright © 2021 Theme_Nate. All rights reserved.</p>
                        <span>
                            <a href="" class="text-gray me-3">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content END -->
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('assets_dashboard/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets_dashboard/js/pages/dashboard.js') }}"></script>
    <!-- Core JS -->
    <script src="{{ asset('assets_dashboard/js/app.min.js') }}"></script>

</body>

</html>
