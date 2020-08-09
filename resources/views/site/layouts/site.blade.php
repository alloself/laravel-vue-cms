<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/favicon.png" rel="icon" type="image/png" sizes="48x48">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(isset($page->keywords))
    <meta name="keywords" content="{{$page->keywords}}">
    @endif
    @if(isset($page->description))
    <meta name="description" content="{{$page->description}}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($page))
    <title>{{$page->title}}</title>
    @else
    <title></title>
    @endif

</head>

<body>
    @component('components.nav')
    @endcomponent
    <main class="main-content">
        @yield('content')
    </main>
    @component('components.footer')
    @endcomponent
</body>

</html>