<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            @include('partials.pre-loader')

            @include('partials.admin-nav')

            <!-- begin app-container -->
            <div class="app-container">

                @include('partials.admin-sidebar')

                @yield('content')

            </div>
            <!-- end app-container -->

        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    @include('partials.script')
</body>


</html>
