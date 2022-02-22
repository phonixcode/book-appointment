<title>@yield('title')-{{ config('app.name', 'Book Appoitment') }}</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- app favicon -->
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
<!-- google fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<!-- plugin stylesheets -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.css') }}" />
<!-- app style -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
