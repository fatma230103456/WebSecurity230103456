

<?php $__env->startSection('title', 'Even Numbers'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mb-0">Even Numbers (1-100)</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                <?php $__currentLoopData = range(1, 100); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge <?php echo e($number % 2 == 0 ? 'bg-primary' : 'bg-secondary'); ?>">
                        <?php echo e($number); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/even.blade.php ENDPATH**/ ?>