<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="base-url" content="{{ url('/') }}">

<title>{{ $title }} {{ ' | ' . config('app.name', 'Laravel') }}</title>

<link rel="icon" href="{{ asset('images/logos/icon-logo.svg') }}" type="image/png" sizes="16x16">

<!-- fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<!-- bootstrap icon-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/hideNumberTypeInputScroll.css') }}"> --}}

<!-- style stack -->
@stack('style')
