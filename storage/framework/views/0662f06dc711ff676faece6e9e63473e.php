

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('libs/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.css')); ?>" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('sidebar-content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <?php if(session('success')): ?>
    <div class="alert alert-success mt-3">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="alert alert-danger mt-3">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="row justify-content-center mt-5">
        <div class="withdraw-section text-center mt-4">
            <form action="<?php echo e(route('wallet.withdraw')); ?>" method="POST" id="withdrawForm">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-2">
                            <input type="text" id="upi_id" name="upi_id" class="form-control" placeholder="Enter your UPI ID" required>
                        </div>

                        <input type="hidden" id="wallet_balance" name="wallet_balance" value="<?php echo e($wallet_balance); ?>">

                        <div class="col-2">
                            <button type="submit" class="btn btn-success w-100">Withdraw</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <table class="datatables-basic table" id="payment-tbl">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Transaction Type</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $num = 1; ?>
                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($num); ?></td>
                            <td>$<?php echo e(number_format($payment->amount, 2)); ?></td>
                            <td><?php echo e(date('d M, Y', strtotime($payment->transaction_date))); ?></td>
                            <td><?php echo e(ucwords($payment->status)); ?></td>
                            <td><?php echo e(ucwords($payment->transaction_type)); ?></td>
                        </tr>
                        <?php $num++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

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
<?php echo $__env->make(Auth::user()->role->name === 'Advertiser' ? 'advertiser.menu' : 'publisher.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/publisher/wallet.blade.php ENDPATH**/ ?>