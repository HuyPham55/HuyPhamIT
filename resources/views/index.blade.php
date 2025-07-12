<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @vite(['resources/ts/app.ts'])
    <title>{{config('app.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(cachedOption('site_favicon')) }}"/>
</head>
<body>
    <div id="app"></div>
</body>
</html>
