<?php
/**
 * Created by PhpStorm.
 * 페이지 이름:        master
 * 페이지 설명:        모든 HTML 페이지의 공통요소를 정의하는 최상위 레이아웃 페이지
 * 만든이:             3-WDJ 1401213 이승민
 * Date:               2018-03-16
 * Time:               오후 3:16
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ $title }}</title>

    {{-- 이하 jQuery와 BootStrap은 FlashMessage의 활성화를 위해 반드시 필요함 --}}
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- jQuery -->
    <script language="JavaScript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js "></script>
    <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.2/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-router@3.0.1/dist/vue-router.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <style type="text/css">
        .footer {
            position:       absolute;
            bottom:         0;
            width:          100%;
            height:         70px;
        }
    </style>
    <!-- style 호출영역 -->
    @yield('style')
    @yield('style_logout')
    @yield('style_toolbar')

    @include('flash::message')
    <header>
        @yield('body.header')
    </header>
    <section>
        @yield('body.section')
    </section>
    <footer class="footer">
        {{--@yield('body.footer')--}}
        @include('partials.footer')
    </footer>
    <script language="JavaScript">
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    <!-- js 호출영역 -->
    @yield('script')
    @yield('script_toolbar')

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script language="JavaScript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>
