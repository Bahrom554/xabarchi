<!doctype html>
<html lang="en" class="semi-dark">

@include('admin.layouts.head')

<body>


    <!--start wrapper-->
    <div class="wrapper ">
        <!--start top header-->
        @include('admin.layouts.header')
        <!--end top header-->
        <!--start sidebar -->
        @include('admin.layouts.sidebar')
        <!--end sidebar -->
        <main class="page-content">
            @yield('content')
        </main>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap bundle JS -->
    @include('admin.layouts.footer')

</body>

</html>
