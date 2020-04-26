<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename(__($page_title) ?? '') }}</title>
    <link rel="shortcut icon" type="image/png"
          href="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}"/>
    @stack('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/dashboard.min.css')}}">
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/custom.css')}}">
    @stack('style')
    <link rel="stylesheet"
          href='{{ asset(activeTemplate(true) . "users/css/color.php?color=$general->bclr&color2=$general->sclr")}}'>
</head>
<body>
@yield('panel')

<script src="{{asset(activeTemplate(true) .'users/js/dashboard.min.js')}}"></script>
<script src="{{asset(activeTemplate(true) .'users/js/main.js')}}"></script>

@stack('script-lib')

<!-- Load toast -->
@include('partials.notify')

<script src="{{asset(activeTemplate(true) .'users/js/nicEdit.js')}}"></script>
{{-- LOAD NIC EDIT --}}
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        $(".nicEdit").each(function (index) {
            $(this).attr("id", "nicEditor" + index);
            new nicEditor({fullPanel: true}).panelInstance('nicEditor' + index, {hasPanel: true});
        });
    });
</script>

<script>$('[data-toggle=tooltip]').tooltip();</script>
@stack('script')
@stack('js')
</body>
</html>
