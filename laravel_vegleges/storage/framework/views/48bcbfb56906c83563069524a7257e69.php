<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Character Details</title>
    </head>

    <body>

        <h1><?php echo e($character->name); ?> Details</h1>

        <ul>
            <li>Name: <?php echo e($character->name); ?></li>
            <li>Defence: <?php echo e($character->defence); ?></li>
            <li>Strength: <?php echo e($character->strength); ?></li>
            <li>Accuracy: <?php echo e($character->accuracy); ?></li>
            <li>Magic: <?php echo e($character->magic); ?></li>
        </ul>

        <h2>Matches</h2>
        <ul>
            <?php $__currentLoopData = $character->contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('contest.show', $contest->id)); ?>">
                        <?php echo e($contest->place->name); ?> -
                        <?php echo e($contest->characters->where('id', '!=', $character->id)->first() ? $contest->characters->where('id', '!=', $character->id)->first()->name : 'N/A'); ?>



                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>


        <a href="<?php echo e(route('characters.edit', $character->id)); ?>"><button>Edit</button></a>

        <form method="POST" action="<?php echo e(route('characters.destroy', $character->id)); ?>"
            onsubmit="return confirm('Are you sure you want to delete this character?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button type="submit">Delete Character</button>
        </form>

        <?php if($character->enemy === 0): ?>
            <form method="POST" action="<?php echo e(route('characters.contest', $character->id)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit">Start New Contest</button>
            </form>
        <?php endif; ?>


    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Desktop/laravel copy 8/beadando/resources/views/character-details.blade.php ENDPATH**/ ?>