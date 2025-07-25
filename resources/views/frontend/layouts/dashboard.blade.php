<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    @include('frontend.layouts.parts.dashboard.head')
</head>

<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M925QQDF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('frontend.layouts.parts.dashboard.sidebar')
            <!-- Layout container -->
            <div class="layout-page">
                @include('frontend.layouts.parts.dashboard.navbar')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Content -->
                        @yield('content')
                        <!-- / Content -->
                        @include('frontend.layouts.parts.dashboard.footer')
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>



    @include('frontend.layouts.parts.dashboard.footer_scripts')



</body>

</html>