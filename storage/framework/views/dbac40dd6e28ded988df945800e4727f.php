
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('libs/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.css')); ?>" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('sidebar-content'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('My Orders')); ?>

                    <a href="<?php echo e(route('publisher.orders.create')); ?>" class="btn btn-outline-primary float-end">+ Add Order</a>
                </div>
            </div>
        </div>
    </div> -->
    <?php if(session('success')): ?>
    <div class="alert alert-primary mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                <?php if(isset($payments) && count($payments) > 0): ?>
                <div class="card-datatable table-responsive pt-0">
                    <?php if($userDetail->role->name == 'Advertiser'): ?>
                    <table class="datatables-basic table" id="payment-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">View Order</th>
                                <th scope="col">Transaction Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Transaction Method</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $num = 1; ?>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(date('d M, Y',strtotime($v->order_date))); ?></td>
                                <td><a href="<?php echo e(route('order.info', $v->o_id)); ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td><?php echo e($v->payment_type); ?></td>
                                <td>$<?php echo e($v->payment_amount); ?></td>
                                <td><?php echo e($v->payment_method); ?></td>
                                <td><?php echo e(date('d M, Y', strtotime($v->created_at))); ?></td>
                                <td><?php echo e(ucwords($v->payment_status)); ?></td>
                            </tr>
                            <?php $num++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <table class="datatables-basic table" id="payment-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">View Order</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $num = 1; ?>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($num); ?></td>
                                <td><a href="<?php echo e(route('order.info', $v->o_id)); ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td><?php echo e($v->payment_id); ?></td>
                                <td>$<?php echo e($v->payment_amount); ?></td>
                                <td><?php echo e(date('d M, Y', strtotime($v->created_at))); ?></td>
                                <td><?php echo e(ucwords($v->payment_status)); ?></td>
                            </tr>
                            <?php $num++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <div class="alert alert-info text-center m-3">No record found!</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    var table = $('#payment-tbl').DataTable();
</script>
<script src="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset_url('libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset_url('js/forms-selects.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(Auth::user()->role->name === 'Advertiser' ? 'advertiser.menu' : 'publisher.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/payment.blade.php ENDPATH**/ ?>