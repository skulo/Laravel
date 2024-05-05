<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Game</title>
    <style>
        nav {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        body {
            background-color: #ccc;

        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="<?php echo e(url('/')); ?>">Main Menu</a></li>
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->admin): ?>
                    <li><a href="<?php echo e(route('places.index')); ?>">Places</a></li>
                <?php endif; ?>
            <?php endif; ?>


            <?php if(Route::has('login')): ?>
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('characters.index')); ?>">Characters</a></li>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"
                            class="text-sm text-gray-700 underline">Log out</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>

                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-700 underline">Log in</a>
                    </li>

                    <?php if(Route::has('register')): ?>
                        <li>
                            <a href="<?php echo e(route('register')); ?>" class="ml-4 text-sm text-gray-700 underline">Register</a>

                        </li>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endif; ?>
        </ul>
    </nav>

    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

</body>

</html>
<?php /**PATH /Users/vargaboldizsar/Downloads/laravel_vegleges/resources/views/layouts/app.blade.php ENDPATH**/ ?>