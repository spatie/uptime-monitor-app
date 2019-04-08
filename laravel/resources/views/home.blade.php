<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Fast2Pay Status</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }

            html,
            body {
            overflow-x: hidden; /* Prevent scroll on narrow devices */
            }

            body {
            padding-top: 56px;
            }

            @media (max-width: 991.98px) {
            .offcanvas-collapse {
                position: fixed;
                top: 56px; /* Height of navbar */
                bottom: 0;
                left: 100%;
                width: 100%;
                padding-right: 1rem;
                padding-left: 1rem;
                overflow-y: auto;
                visibility: hidden;
                background-color: #343a40;
                transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
                transition: transform .3s ease-in-out, visibility .3s ease-in-out;
                transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
            }
            .offcanvas-collapse.open {
                visibility: visible;
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }
            }

            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }

            .nav-scroller .nav {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                color: rgba(255, 255, 255, .75);
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .nav-underline .nav-link {
                padding-top: .75rem;
                padding-bottom: .75rem;
                font-size: .875rem;
                color: #6c757d;
            }

            .nav-underline .nav-link:hover {
                color: #007bff;
            }

            .nav-underline .active {
                font-weight: 500;
                color: #343a40;
            }

            .text-white-50 { color: rgba(255, 255, 255, .5); }

            .bg-down { background-color: #f44336; }
            .bg-up { background-color: #8bc34a; }

            .lh-100 { line-height: 1; }
            .lh-125 { line-height: 1.25; }
            .lh-150 { line-height: 1.5; }
        </style>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Status <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="container">
            <?php
                $classAll = ($downCount > 0) ? 'bg-down' : 'bg-up';
                $isUp = ($downCount > 0) ? FALSE : TRUE;
            ?>
            <div class="d-flex align-items-center p-3 my-3 text-white-50 {{$classAll}} rounded shadow-sm">
                @if ($isUp)
                    <img class="mr-3" src="https://fast2pay-cdn.sfo2.digitaloceanspaces.com/all-up.png" alt="" width="48" height="48">
                @else
                    <img class="mr-3" src="https://fast2pay-cdn.sfo2.digitaloceanspaces.com/all-down.png" alt="" width="48" height="48">
                @endif
                <div class="lh-100">
                    @if ($isUp)
                        <h6 class="mb-0 text-white lh-100">All services Operational</h6>
                        <small>No issues found in our systems.</small>
                    @else
                        <h6 class="mb-0 text-white lh-100">We find a failure in one of our services</h6>
                        <small>We are working to resolve this issue as soon as possible.</small>
                    @endif
                </div>
            </div>

            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Production Status</h6>

                <?php foreach ($monitorsListProduction as $key => $value) { ?>
                    <?php $fillColor = ($value->uptime_status == 'down') ? '#f44336' : '#8bc34a'; ?>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="{{$fillColor}}"></rect><text x="50%" y="50%" fill="{{$fillColor}}" dy=".3em">32x32</text></svg>

                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark">[{{$value->environment}}]: {{$value->url}}</strong>

                            <br/>
                            <b>Status:</b>
                            @if ($value->uptime_check_failure_reason)
                                {{$value->uptime_check_failure_reason}}
                            @else
                                The service is up
                            @endif

                            <br/><b>Check date:</b> {{date('d/m/Y H:i:s', strtotime($value->uptime_last_check_date))}}
                            <br/><b>Certificate expiration:</b> {{date('d/m/Y H:i:s', strtotime($value->certificate_expiration_date))}}
                        </p>
                    </div>
                <?php }  ?>
            </div>

            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Testing Status</h6>

                <?php foreach ($monitorsListTesting as $key => $value) { ?>
                    <?php $fillColor = ($value->uptime_status == 'down') ? '#f44336' : '#8bc34a'; ?>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="{{$fillColor}}"></rect><text x="50%" y="50%" fill="{{$fillColor}}" dy=".3em">32x32</text></svg>

                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark">[{{$value->environment}}]: {{$value->url}}</strong>

                            <br/>
                            <b>Status:</b>
                            @if ($value->uptime_check_failure_reason)
                                {{$value->uptime_check_failure_reason}}
                            @else
                                The service is up
                            @endif

                            <br/><b>Check date:</b> {{date('d/m/Y H:i:s', strtotime($value->uptime_last_check_date))}}
                            <br/><b>Certificate expiration:</b> {{date('d/m/Y H:i:s', strtotime($value->certificate_expiration_date))}}
                        </p>
                    </div>
                <?php }  ?>
            </div>
        </main>
    </body>
    <!-- Scripts -->
    <script>
    setTimeout(function(){
        window.location.reload(1);
    }, 30000);
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
