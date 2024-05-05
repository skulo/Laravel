<?php $__env->startSection('content'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
    <style>
        body {
            background-image: url('<?php echo e(asset('storage/' . $place->image)); ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            color: white; 
            padding: 20px; 
            
        }
        
    </style>
</head>
<body>


<div class="container" style="background-color: rgba(17, 14, 14, 0.8);">
    <h1>Contest in <?php echo e($contest->place->name); ?></h1>
    
    <h2 style="color: blue"><?php echo e($contest->characters[0]->name); ?></h2>
    <ul>

        <li>Defence: <?php echo e($contest->characters[0]->defence); ?></li>
        <li>Strength: <?php echo e($contest->characters[0]->strength); ?></li>
        <li>Accuracy: <?php echo e($contest->characters[0]->accuracy); ?></li>
        <li>Magic: <?php echo e($contest->characters[0]->magic); ?></li>
        <li>Health: <?php echo e($contest->characters[0]->pivot->hero_hp); ?></li>
    </ul>
    
    <h2 style="color: red"><?php echo e($contest->characters[1]->name); ?></h2>
    <ul>
        <li>Defence: <?php echo e($contest->characters[1]->defence); ?></li>
        <li>Strength: <?php echo e($contest->characters[1]->strength); ?></li>
        <li>Accuracy: <?php echo e($contest->characters[1]->accuracy); ?></li>
        <li>Magic: <?php echo e($contest->characters[1]->magic); ?></li>
        <li>Health: <?php echo e($contest->characters[1]->pivot->enemy_hp); ?></li>
    </ul>
    
    <?php if($contest->win === null && $contest->characters[0]->user_id == auth()->id()): ?>
        <h2>Actions</h2>
        <form method="POST" action="<?php echo e(route('contest.attack', ['contest' => $contest, 'attackType' => 'melee'])); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" name="action" value="melee">Melee Attack</button>
        </form>
        
        <form method="POST" action="<?php echo e(route('contest.attack', ['contest' => $contest, 'attackType' => 'ranged'])); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" name="action" value="ranged">Ranged Attack</button>
        </form>
        
        <form method="POST" action="<?php echo e(route('contest.attack', ['contest' => $contest, 'attackType' => 'special'])); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" name="action" value="special">Special Attack</button>
        </form>
        
    <?php else: ?>
        
    <?php if($contest->win): ?>
    <h2 style="color: rgb(0, 172, 11)">Victory</h2>
    <?php else: ?>
    
    <?php if($contest->win!== null): ?>
    <h2 style="color: red">Defeat</h2>
    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>

    <h2>History</h2>
    <div>
        <ul>
            <?php $__currentLoopData = explode('<br>', $contest->history ?? ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(Str::startsWith($event, $contest->characters[0]->name)): ?>
                    <li style="color: blue"><?php echo e($event); ?></li>
                <?php else: ?>
                    <li style="color: red"><?php echo e($event); ?></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vargaboldizsar/Desktop/laravel/beadando/resources/views/contest.blade.php ENDPATH**/ ?>