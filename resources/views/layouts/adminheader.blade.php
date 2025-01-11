<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.name')}}</title>
        <meta charset="utf-8" />

        {{-- fav icon --}}
        <link href="{{asset('assets/img/fav/favicon.png')}}" rel="icon" type="image/png" sizes="16x16" />

        {{-- bootstrap css1 js1 --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        {{-- fontawesome css1  --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- jquery ui css1 js1 --}}
        <link href="{{asset('/assets/libs/jquery-ui-1.13.2.custom/jquery-ui.min.css')}}" rel="stylesheet"  />
        
        
        {{-- custom css css1 --}}
        <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
    
        {{-- toaster notification css --}}
        <link href="{{asset('assets/libs/toastr-master/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />
        
        {{-- flatpickr css --}}
        <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
       

        @yield('css')

    </head>
    <body></body>   