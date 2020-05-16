@extends(activeTemplate().'member.layouts.member-master')

@section('panel')
<div class="main-container" id="app">
    <div class="container-fluid main-body-wrapper">
        @include(activeTemplate().'member.partials.sidenav')
        <div class="main-panel-wrapper">
            @include(activeTemplate().'member.partials.topnav')
            @include(activeTemplate().'member.partials.breadcrumb')
            <div class="content-wrapper">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </div>
            <footer class="footer"></footer>
        </div>
    </div>
</div>
@endsection
