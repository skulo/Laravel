<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Character</title>
</head>
<body>


<form method="POST" action="<?php echo e(route('characters.update', $character->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo e(old('name', $character->name)); ?>" required>
    </div>

    <div>
        <label for="defence">Defence:</label>
        <input type="number" id="defence" name="defence" min="0" max="3" value="<?php echo e(old('defence', $character->defence)); ?>" required>
    </div>

    <div>
        <label for="strength">Strength:</label>
        <input type="number" id="strength" name="strength" min="0" max="20" value="<?php echo e(old('strength', $character->strength)); ?>" required>
    </div>

    <div>
        <label for="accuracy">Accuracy:</label>
        <input type="number" id="accuracy" name="accuracy" min="0" max="20" value="<?php echo e(old('accuracy', $character->accuracy)); ?>" required>
    </div>

    <div>
        <label for="magic">Magic:</label>
        <input type="number" id="magic" name="magic" min="0" max="20" value="<?php echo e(old('magic', $character->magic)); ?>" required>
    </div>



    <input type="hidden" id="enemy" name="enemy" value="<?php echo e($character->enemy); ?>">
   
    <button type="submit">Update Character</button>

    <?php $__errorArgs = ['error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</form>



</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Desktop/laravel/beadando/resources/views/characteredit.blade.php ENDPATH**/ ?>