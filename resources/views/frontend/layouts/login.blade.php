<!DOCTYPE html>
<html lang="zxx">
    <head>
        @include('layouts.parts.login.head')
    </head>
    <body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M925QQDF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <div class="container-xxl">
            @yield('content')
        </div>
        @include('layouts.parts.login.footer_scripts')
    </body>
</html>