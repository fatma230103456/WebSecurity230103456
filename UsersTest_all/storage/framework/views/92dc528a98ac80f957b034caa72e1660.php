
<?php $__env->startSection('title', 'Product Catalog'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Product Catalog</h1>
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?php echo e($product->image); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($product->name); ?></h5>
                    <p class="card-text"><?php echo e($product->description); ?></p>
                    <p class="card-text"><strong>Price: $<?php echo e(number_format($product->price, 2)); ?></strong></p>
                    <button class="btn btn-primary w-100">Add to Cart</button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/Products.blade.php ENDPATH**/ ?>