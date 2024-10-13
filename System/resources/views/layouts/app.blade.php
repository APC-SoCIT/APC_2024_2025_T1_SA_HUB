<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta http-equiv="refresh" content="1800">
    <link rel="icon" href="{{ asset('/images/logo.png') }}">

    {{-- Google Font Fredoka --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wdth,wght@75..125,300..700&display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <!--Bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])


</head>

<body class="container-fluid px-0">
    <div id="app">
        <div class=" content">
            @yield('content')
        </div>
        <div class="row d-md-none vh-100 ">
            <div class="small-screen-message col">
                <!-- Message that will be shown on small screens -->
                <p>This website is only accessible on medium to large screens. Please use a larger device.</p>
            </div>
        </div>
    </div>


    <!--Bootstrap JS/Popper CDN-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script> --}}


    <!-- JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('fade-in');

            $('change-page').on('click', function(e) {
                e.preventDefault(); // Prevent the default action
                var link = $(this).attr('href'); // Get the link

                // Fade out the page
                $('body').removeClass('fade-in').addClass('fade');

                // Redirect after the fade-out animation
                setTimeout(function() {
                    window.location.href = link;
                }, 500); // Match the duration of the CSS transition
            });

            // Check the window width when the page loads
            if ($(window).width() >= 768) {
                $('.content').show(); // Show the main content
            } else {
                $('.small-screen-message').show(); // Show small screen message
            }

            // Recheck when the window is resized
            $(window).resize(function() {
                if ($(window).width() >= 768) {
                    $('.content').show(); // Show content on larger screens
                    $('.small-screen-message').hide(); // Hide message
                } else {
                    $('.content').hide(); // Hide content on small screens
                    $('.small-screen-message').show(); // Show message
                }
            });


        });
    </script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    @yield('scripts')

</body>
</body>
</html>
