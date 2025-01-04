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
    <script src="//unpkg.com/alpinejs" defer></script>
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
    <title>JobJunction | Find Jobs & Projects</title>
</head>

<body class="mb-48">
    <!--
        The nav section contains the main navigation menu for the application.
    -->
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo" /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            <?php if(auth()->guard()->check()): ?>
                <li>
                    <span class="font-bold uppercase">Welcome <?php echo e(auth()->user()->name); ?></span>
                </li>
                <li>
                    <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i>
                        Manage Listings</a>
                </li>
                <li>
                    <form class="inline" action="/logout" method="post">
                        <?php echo csrf_field(); ?>
                        <button type="submit">
                            <i class="fa-solid fa-door-open"></i> Logout
                        </button>
                    </form>
                </li>
            <?php else: ?>
                <li>
                    <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <?php echo e($slot); ?>

    </main>
    <!--
        The footer section contains the copyright information and a call-to-action button.
    -->
    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-white text-black h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
        <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
    </footer>
    <?php if (isset($component)) { $__componentOriginalbb0843bd48625210e6e530f88101357e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbb0843bd48625210e6e530f88101357e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $attributes = $__attributesOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__attributesOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $component = $__componentOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__componentOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>
</body>

</html>
<?php /**PATH C:\Users\Acer\CodeGigz\CodeGigz\resources\views/components/layout.blade.php ENDPATH**/ ?>