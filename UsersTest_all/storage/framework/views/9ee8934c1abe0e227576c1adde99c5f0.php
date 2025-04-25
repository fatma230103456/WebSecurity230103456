

<?php $__env->startSection('title', 'Products List'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Products List</h1>

    <form>
        <div class="row">
            <div class="col col-sm-2">
                <input name="keywords" type="text" class="form-control" placeholder="Search Keywords" value="<?php echo e(request()->keywords); ?>" />
            </div>
            <div class="col col-sm-2">
                <input name="min_price" type="number" class="form-control" placeholder="Min Price" value="<?php echo e(request()->min_price); ?>" />
            </div>
            <div class="col col-sm-2">
                <input name="max_price" type="number" class="form-control" placeholder="Max Price" value="<?php echo e(request()->max_price); ?>" />
            </div>
            <div class="col col-sm-2">
                <select name="order_by" class="form-select">
                    <option value="" <?php echo e(request()->order_by==""?"selected":""); ?> disabled>Order By</option>
                    <option value="name" <?php echo e(request()->order_by=="name"?"selected":""); ?>>Name</option>
                    <option value="price" <?php echo e(request()->order_by=="price"?"selected":""); ?>>Price</option>
                </select>
            </div>
            <div class="col col-sm-2">
                <select name="order_direction" class="form-select">
                    <option value="" <?php echo e(request()->order_direction==""?"selected":""); ?> disabled>Order Direction</option>
                    <option value="ASC" <?php echo e(request()->order_direction=="ASC"?"selected":""); ?>>ASC</option>
                    <option value="DESC" <?php echo e(request()->order_direction=="DESC"?"selected":""); ?>>DESC</option>
                </select>
            </div>
            <div class="col col-sm-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col col-sm-1">
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12 col-lg-4">
                        <img src="<?php echo e(asset('images/' . $product->photo)); ?>" class="img-thumbnail" alt="<?php echo e($product->name); ?>" width="100%">
                    </div>
                    <div class="col col-sm-12 col-lg-8 mt-3">
                        <h3><?php echo e($product->name); ?></h3>
                        <table class="table table-striped">
                            <tr>
                                <th width="20%">Name</th>
                                <td><?php echo e($product->name); ?></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><?php echo e($product->model); ?></td>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <td><?php echo e($product->code); ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?php echo e($product->description); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="row mt-2">
    <div class="col col-10">
        <h1>Products</h1>
    </div>
    <div class="col col-2">
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('products_edit')); ?>" class="btn btn-success form-control">Add Product</a>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/products/list.blade.php ENDPATH**/ ?>