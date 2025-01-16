

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('libs/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('sidebar-content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('My Orders')); ?>

                </div>
            </div>
        </div>
    </div>
    <?php if(session('success')): ?>
    <div class="alert alert-primary mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                <?php if(isset($orders) && count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Website</th>
                                <th scope="col">Article Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Status</th>
                                <th scope="col">Orders Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            ?>
                            <tr aria-expanded="false">
                                <td><?php echo e(date('d M, Y',strtotime($v->order_date))); ?></td>
                                <td><a href="<?php echo e(route('order.info', $v->order_id)); ?>" title="<?php echo e($v->order_id); ?>"><?php echo e(($v->order_id)); ?></a></td>
                                <td><a href="<?php echo e($v->website->website_url); ?>" target="_blank" title="Web Site Link (<?php echo e($v->website->website_url); ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="<?php echo e($v->website->website_url); ?>"><?php echo e($v->website->website_url); ?></a></td>
                                <td>
                                    <?php if($v->attachment != ''): ?>
                                    <?php
                                    // Assuming $v->article_title is an array or a comma-separated string
                                    $titles = is_array($v->article_title) ? implode(", ", $v->article_title) : $v->article_title;
                                    ?>

                                    <a href="<?php echo e(url('/storage/app/'.$v->attachment)); ?>" target="_blank" title="Attachment Link"><?php echo e($titles); ?></a>
                                    <?php else: ?>
                                    Data Not Found
                                    <?php endif; ?>
                                </td>
                                <td>$<?php echo e($v->price); ?></td>
                                <td><?php echo e($v->attachment_type); ?></td>
                                <td><?php echo e($v->quantity); ?></td>
                                <td><?php echo e(ucwords($v->payment_status)); ?></td>
                                <td><?php echo e(ucwords($v->status)); ?></td>
                                <td>
                                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle<?php echo e($v->id); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo e(ucwords($v->advertiser_status)); ?>

                                    </button>
                                    <?php if($v->status == 'complete'): ?>

                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item orderStatus<?php echo e($v->id); ?> <?php echo e($v->advertiser_status == 'new' ? 'active' : ''); ?>" onclick="updateOrderStatus(<?php echo e($v->id); ?>, 'new')">New</li>
                                        <li class="dropdown-item orderStatus<?php echo e($v->id); ?> <?php echo e($v->advertiser_status == 'complete' ? 'active' : ''); ?>" onclick="updateOrderStatus(<?php echo e($v->id); ?>, 'complete')">Complete</li>
                                        <li class="dropdown-item orderStatus<?php echo e($v->id); ?> <?php echo e($v->advertiser_status == 'change' ? 'active' : ''); ?>" onclick="showChangeModal(<?php echo e($v->id); ?>)">Change</li>
                                    </ul>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="alert alert-info text-center m-3">No record found!</div>
                <?php endif; ?>
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

<!-- Modal for Change Status -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm">
                    <div class="mb-3">
                        <label for="changeReason" class="form-label">Change</label>
                        <textarea class="form-control" id="changeReason" name="reason" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="orderId" name="order_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitChange()">Submit</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    function updateOrderStatus(orderId, status) {
        if (status !== 'change') {
            $.ajax({
                url: "<?php echo e(route('update.order.status')); ?>",
                method: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: orderId,
                    status: status,
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Error updating status.');
                    }
                }
            });
        }
    }

    function showChangeModal(orderId) {
        $('#orderId').val(orderId);
        $('#changeStatusModal').modal('show');
    }

    function submitChange() {
        const reason = $('#changeReason').val();
        const orderId = $('#orderId').val();

        if (reason.trim() === '') {
            alert('Reason is required.');
            return;
        }

        $.ajax({
            url: "<?php echo e(route('update.order.status')); ?>",
            method: "POST",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                id: orderId,
                status: 'change',
                reason: reason,
            },
            success: function(response) {
                if (response.success) {
                    $('#changeStatusModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating status.');
                }
            }
        });
    }
</script>
<script>
    var table = $('#order-tbl').DataTable({
        "columns": [{
                "width": "11%"
            },
            null, // Column 2 (Order ID)
            null, // Column 3 (Website)
            null, // Column 4 (Article Title)
            null, // Column 5 (Price)
            null, // Column 6 (Type)
            null, // Column 7 (Quantity)
            null, // Column 8 (Payment Status)
            null, // Column 9 (Status)
            null
        ]
    });
</script>
<script src="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset_url('libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset_url('js/forms-selects.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('advertiser.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/advertiser/orders.blade.php ENDPATH**/ ?>