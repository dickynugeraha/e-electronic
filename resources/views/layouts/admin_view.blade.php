<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.header_script')
    <title>{{ $title ?? "e-bag abel" }}</title>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">E - Bag Abel</a>
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="/logout">Logout</a>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.header_admin')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content_admin')
            </main>
        </div>
    </div>
</body>
@yield('add_javascript')
@include('layouts.partials.footer_script')

</html>