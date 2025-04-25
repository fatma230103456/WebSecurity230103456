
<?php $__env->startSection('title', 'Bill Page'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><?php echo e($bill->supermarket); ?> - POS #<?php echo e($bill->pos); ?></h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Price (per unit)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bill->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->quantity); ?></td>
                        <td><?php echo e($product->unit); ?></td>
                        <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                        <td>$<?php echo e(number_format($product->quantity * $product->price, 2)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                        <td><strong>$<?php echo e(number_format(array_reduce($bill->products, function($carry, $product) {
                            return $carry + ($product->quantity * $product->price);
                        }, 0), 2)); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/bill.blade.php ENDPATH**/ ?>