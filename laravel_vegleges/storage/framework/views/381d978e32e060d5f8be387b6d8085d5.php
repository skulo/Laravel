<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to the Game</title>
    </head>

    <body>
        <h1>Game Description</h1>

        <p>This is a game, where you can create your own characters, and start contests with enemies at different places.
        </p>

        <h2>Statistics</h2>
        <ul>
            <li>Total number of characters: <?php echo e($totalCharacters); ?></li>
            <li>Total number of contests: <?php echo e($totalContests); ?></li>


        </ul>
    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Downloads/laravel_vegleges/resources/views/welcome.blade.php ENDPATH**/ ?>