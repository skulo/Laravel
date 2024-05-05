<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Characters</title>
    </head>

    <body>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Defence</th>
                    <th>Strength</th>
                    <th>Accuracy</th>
                    <th>Magic</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $characters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $character): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="color: <?php echo e($character->enemy ? 'red' : 'blue'); ?>"><?php echo e($character->name); ?></td>
                        <td><?php echo e($character->defence); ?></td>
                        <td><?php echo e($character->strength); ?></td>
                        <td><?php echo e($character->accuracy); ?></td>
                        <td><?php echo e($character->magic); ?></td>
                        <td><a href="<?php echo e(route('characters.show', $character->id)); ?>"><button>Details</button></a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('characters.create')); ?>"><button>Create New Character</button></a>
    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Desktop/laravel copy 8/beadando/resources/views/characters.blade.php ENDPATH**/ ?>