<!DOCTYPE html>
<html lang="en">


<head>
    @include('partials.head')
</head>

<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            @include('partials.pre-loader')
            <!--start contant-->
            @yield('content')
            <!--end contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->
    @include('partials.script')
</body>

</html>
