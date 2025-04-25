
  <?php $__env->startSection('title', 'Multiplication'); ?>
  <?php $__env->startSection('content'); ?>
      <?php ($j = 5); ?>
  <div class="card m-4 col-sm-2">
    <div class="card-header"><?php echo e($j); ?> Multiplication Table</div>
    <div class="card-body">
      <table>
        <?php $__currentLoopData = range(1, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr><td><?php echo e($i); ?> * <?php echo e($j); ?></td><td> = <?php echo e($i * $j); ?></td></li>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>
    </div>
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest\resources\views/multable.blade.php ENDPATH**/ ?>