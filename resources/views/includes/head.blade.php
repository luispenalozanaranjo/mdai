<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<title>{{ getPageTitle() }}</title>

	<!-- Global metas -->
	<meta name="description" content="{{ getPageDescription() }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="canonical" href="{{ url()->current() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="Nicolás Arce | www.narce.cl">
	<meta property="og:site_name" content="{{ config('app.name') }}">
	<meta property="og:locale" content="{{ app()->getLocale() }}">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:site_name" content="{{ config('app.name') }}">
	<meta property="og:type" content="website">
	<link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Rubik&display=swap" rel="stylesheet"> 

	<!-- Main style -->
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body onunload="">