<!DOCTYPE html>
<html>

<head>
    <base href="/hadmin/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title> @yield('hAdmin- 主页')</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/hadmin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/hadmin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/hadmin/css/animate.css" rel="stylesheet">
    <link href="/hadmin/css/style.css?v=4.1.0" rel="stylesheet">

    
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div class="container">
    
        @yield('content')
    </div>


</body>

</html>
