
<?php $__env->startPush('css'); ?>
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
                <?php if(isset($orders) && count($orders) > 0): ?>
                <?php echo csrf_field(); ?>
                <div class="m-3">
                    <input type="hidden" id="url" value="<?php echo e(url('order/update-status')); ?>">
                    <div id="alert"></div>
                    <table class="table bg-white" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">ID</th>
                                <th scope="col">Website</th>
                                <th scope="col">Article Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Type</th>
                                <!-- <th scope="col">Time Left</th> -->
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            ?>
                            <tr>
                                <input type="hidden" id="id" name="id" value="<?php echo e($v->id); ?>">
                                <td><?php echo e(date('d M, Y', strtotime($v->order_date))); ?></td>
                                <td><a href="<?php echo e(route('order.info', $v->order_id)); ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td><a href="<?php echo e($v->website_url); ?>" target="_blank" title="Web Site Link (<?php echo e($v->website_url); ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="<?php echo e($v->website_url); ?>">Link <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                <td>
                                    <?php if($v->attachment != ''): ?>
                                    <a href="<?php echo e(url('/storage/app/'.$v->attachment)); ?>"><?php echo e($v->article_title); ?></a>
                                    <?php else: ?>
                                    Data Not Found
                                    <?php endif; ?>
                                </td>
                                <td>$<?php echo e($v->price); ?></td>
                                <td><?php echo e($v->attachment_type); ?></td>
                                <!-- <td><?php echo e(date('Y-m-d h:i:s A', (strtotime($v->delivery_time) - strtotime(date('Y-m-d h:i:s A'))))); ?></td> -->
                                <td><?php echo e($v->quantity); ?></td>
                                <td>
                                    <?php echo e($v->status); ?>

                                </td>
                                <td><?php echo e(ucwords($v->payment_method)); ?></td>
                                <td><?php echo e(ucwords($v->payment_status)); ?></td>
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
    var table = $('#order-tbl').DataTable({
        "columns": [{
                "width": "11%"
            },
            {
                "width": "9%"
            },
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        ]
    });

    function orderStatus($this, $id) {
        $status = $this.data('item');
        $statusText = $this.text();
        $_token = $('input[name="_token"]').val();
        $url = $('#url').val();
        if ($status != '') {
            $.ajax({
                type: 'POST',
                url: $url + '/' + $id,
                data: {
                    '_token': $_token,
                    'status': $status,
                },
                success: function(response) {
                    var $obj = JSON.parse(response);
                    if ($obj.error != '') {
                        $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                    } else {
                        $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                        $('.orderStatus' + $id).removeClass('active');
                        $this.addClass('active');
                        $('.statusBtnTitle' + $id).text($statusText);
                    }
                },
                error: function(error) {
                    // Handle errors
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error + '</li></ul>');
                    // console.log(error);
                }
            });
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('lslbadmin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/lslbadmin/orders.blade.php ENDPATH**/ ?>