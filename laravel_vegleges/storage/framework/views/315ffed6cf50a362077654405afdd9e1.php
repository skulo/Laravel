<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Places</title>
    </head>

    <body>

        <div class="container">
            <h1>Places</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($place->name); ?></td>
                            <td><img src="<?php echo e(asset('storage/' . $place->image)); ?>" alt="<?php echo e($place->name); ?>"
                                    style="max-width: 100px;">

                            </td>
                            </td>
                            <td>
                                <a href="<?php echo e(route('places.edit', $place->id)); ?>"><button>Edit</button></a>
                                <form action="<?php echo e(route('places.destroy', $place->id)); ?>" method="POST"
                                    style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete it?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <a href="<?php echo e(route('places.create')); ?>"><button>Create new place</button></a>

        </div>

    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Desktop/veglegeslaravel copy/resources/views/places/index.blade.php ENDPATH**/ ?>