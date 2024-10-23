<!doctype html>
<!--
* =======================================================================================
* App Name : E-Production
* All copyrights belong to PT. Tantra Fiber Industry
* Developer : Herlambang Yudha Pahlawan, Ahmad Rizki
* All Rights Reserved
* This Website using Template :
* =======================================================================================
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
@include('shared.header')
<div class="main-content">
    @include('shared.script')

    <style>
        .error {
            color: #FF0000;
        }
    </style>

    <body>
        <script src="{{ asset('assets/dist/js/demo-theme.min.js?1684106062') }}"></script>
        @yield('content')
    </body>
</div>

@include('components.alert')
</div>

</html>
