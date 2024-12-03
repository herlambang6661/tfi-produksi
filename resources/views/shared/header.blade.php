<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{ asset('assets/static/icon.png') }}">
    <title>{{ $judul }} - Produksi PT TFI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS files -->
    <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/select2/css/select2.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/extentions/datatables/Select-1.6.0/css/select.bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/placeholder/placeholder-loading.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/richtext/richtext.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .bg-mambo {
            --lightness: 50%;
            background: linear-gradient(90deg,
                    hsl(0, 100%, calc(var(--lightness) * 1.30)),
                    hsl(15, 100%, calc(var(--lightness) * 1.10)),
                    hsl(35, 100%, calc(var(--lightness) * 1.02)),
                    hsl(48, 100%, calc(var(--lightness) * 0.90)),
                    hsl(60, 100%, calc(var(--lightness) * .76)),
                    hsl(72, 100%, calc(var(--lightness) * .71)),
                    hsl(90, 100%, calc(var(--lightness) * .70)),
                    hsl(105, 100%, calc(var(--lightness) * .70)),
                    hsl(120, 100%, calc(var(--lightness) * .695)),
                    hsl(135, 100%, calc(var(--lightness) * .70)),
                    hsl(150, 100%, calc(var(--lightness) * .70)),
                    hsl(165, 100%, calc(var(--lightness) * .69)),
                    hsl(180, 100%, calc(var(--lightness) * .65)),
                    hsl(195, 80%, calc(var(--lightness) * .85)),
                    hsl(215, 75%, calc(var(--lightness) * 1.25)),
                    hsl(225, 100%, calc(var(--lightness) * 1.40)),
                    hsl(240, 100%, calc(var(--lightness) * 1.48)),
                    hsl(255, 100%, calc(var(--lightness) * 1.44)),
                    hsl(270, 100%, calc(var(--lightness) * 1.35)),
                    hsl(285, 100%, calc(var(--lightness) * 1.15)),
                    hsl(300, 90%, calc(var(--lightness) * .89)),
                    hsl(315, 80%, calc(var(--lightness) * .98)),
                    hsl(330, 90%, calc(var(--lightness) * 1.12)),
                    hsl(345, 95%, calc(var(--lightness) * 1.21)),
                    hsl(360, 100%, calc(var(--lightness) * 1.30)));

        }
    </style>
    {{-- Translate Warna --}}
</head>
