
  <?php $__env->startSection('title', 'Even'); ?>
  <?php $__env->startSection('content'); ?>
    <div class="card">
      <div class="card-header">Even Numbers</div>
      <div class="card-body">
        <table>
        <?php $__currentLoopData = range(1, 100); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($i%2==0): ?>
            <span class="badge bg-primary"><?php echo e($i); ?></span>  
          <?php else: ?>
            <span class="badge bg-secondary"><?php echo e($i); ?></span>  
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/even.blade.php ENDPATH**/ ?>