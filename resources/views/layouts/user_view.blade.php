<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.partials.header_script')
  <title>{{$title ?? "e-electronic ari"}}</title>
</head>
<body>
  @include('layouts.partials.header_user')
  <div class="container my-5">
    @yield('content_user')
  </div>
</body>
@yield('add_javascript')
@include('layouts.partials.footer_script')
</html>
