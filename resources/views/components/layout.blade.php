<!-- 
    This is the main layout file for the application. 
    It defines the basic structure of the HTML document and includes the necessary CSS and JavaScript files.
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 
        The head section contains metadata about the document, such as the character encoding, 
        viewport settings, and links to external stylesheets and scripts.
    -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // 
        // This script configures the Tailwind CSS theme to include a custom color palette.
        // 
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>CodeGigs | Find Jobs & Projects</title>
</head>

<body class="mb-48">
    <!-- 
        The nav section contains the main navigation menu for the application.
    -->
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo" /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            <li>
                <a href="register.html" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
                <a href="login.html" class="hover:text-laravel"><i
                        class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li>
        </ul>
    </nav>
    <main>
        {{ $slot }}
    </main>
    <!-- 
        The footer section contains the copyright information and a call-to-action button.
    -->
    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
        <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
    </footer>
</body>

</html>