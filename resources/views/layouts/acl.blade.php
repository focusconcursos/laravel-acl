<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'Laravel APP') }}</title>
    <!-- Material Design fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th{
            vertical-align: middle!important;
        }
    </style>
</head>
<body>
    <!-- Bootstrap navigation -->
    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{ env('APP_NAME', 'Laravel APP') }}</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                @if (!Auth::guest())
                    <ul class="nav navbar-nav">
                        @can('role_index')
                        <li><a href="/roles">Roles</a></li>
                        @endcan
                        @can('permission_index')
                        <li><a href="/permissions">Permission</a></li>
                        @endcan
                    </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/login">Login</a></li>
                @else
                    <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                    </li>
                @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <!-- show flash message -->
        @if (Session::has('flash_message'))
            <div class="alert alert-dismissible alert-info" id="alert-box">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> {{ Session::get('flash_message') }}</strong>
            </div>
        @endif
        <!-- yield view contents -->
        @yield('content')
    </div>
    <hr/>
    <!-- footer -->
    <div class="container">
        &copy; {{ date('Y') }}. copyright © <a href="#" target="_blank">your-domain-goes-here.</a> All rights reserved.<br/>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <!-- yield scripts from views -->
    @yield('script')
    <script>
        $("#alert-box").fadeTo(2000, 500).slideUp(500, function() {
            $("#alert-box").alert('close');
        });
    </script>
</body>
</html>
