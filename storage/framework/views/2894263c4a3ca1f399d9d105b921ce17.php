
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('sidebar-content'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <?php if(session('success')): ?>
    <div class="alert alert-primary mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                <?php if(isset($withdrawals) && count($withdrawals) > 0): ?>
                <?php echo csrf_field(); ?>
                <div class="m-3">
                    <input type="hidden" id="url" value="<?php echo e(url('order/update-status')); ?>">
                    <div id="alert"></div>
                    <table class="table bg-white" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Publisher email</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment info</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($withdrawal->publisher->email); ?></td>
                                <td><?php echo e($withdrawal->transaction_date); ?></td>
                                <td><?php echo e($withdrawal->amount); ?></td>
                                <td>
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment type :</span>
                                        <?php echo e($withdrawal->user->preferred_method ?? 'N/A'); ?>

                                    </div>
                                    <?php if($withdrawal->user->preferred_method == 'paypal'): ?>
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment email:</span>
                                        <?php echo e($withdrawal->payment_email); ?>

                                    </div>
                                    <?php elseif($withdrawal->user->preferred_method == 'razorpay'): ?>
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment id :</span>
                                        <?php echo e($withdrawal->payment_email); ?>

                                    </div>
                                    <?php else: ?>
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">payment_info:</span>
                                        N/A
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <select class="form-select status-dropdown" data-id="<?php echo e($withdrawal->transaction_id); ?>">
                                        <option value="pending" <?php echo e($withdrawal->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="completed" <?php echo e($withdrawal->status == 'completed' ? 'selected' : ''); ?>>Complete</option>
                                    </select>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert alert-info text-center m-3">No record found!</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2"><?php echo e(__('Delete Record')); ?></h3>
                </div>
                <p class="text-wrap"><?php echo e(__("Are you sure you wan't to delete this record!")); ?></p>
                <div class="col-12 text-center">
                    <button type="submit" data-href="" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light delete-yes-btn" onclick="window.location.href = $(this).attr('data-href')"><?php echo e(__('Yes')); ?></button>
                    <button type="reset" class="btn btn-label-secondary btn-reset waves-effect" onclick="$('#delete-yes-btn').data('href','');" data-bs-dismiss="modal" aria-label="Close"><?php echo e(__('No')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        $('#order-tbl').DataTable({
            "order": [
                [5, 'desc']
            ]
        });
    });
</script>
<script>
    $(document).on('change', '.status-dropdown', function() {
        const withdrawalId = $(this).data('id');
        const newStatus = $(this).val();

        $.ajax({
            url: '<?php echo e(route("updateWithdrawalStatus")); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: withdrawalId,
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('lslbadmin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/lslbadmin/withdrawal.blade.php ENDPATH**/ ?>