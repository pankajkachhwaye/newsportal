<!DOCTYPE html>
<html>

@include("layout.headdefault")

<body class="theme-red">
<!-- Page Loader -->
@include("layout.headerdefault");
<!-- #Top Bar -->
@include("layout.asidebardefault")

@yield('main-content')



@include("layout.scriptdefault");
</body>
</html>