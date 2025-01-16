
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('sidebar-content'); ?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('My Website')); ?>

                    <a href="<?php echo e(url('/publisher/website/create')); ?>" class="btn btn-outline-primary float-end"><i class="ti ti-world-plus m-auto p-1"></i> Add Website</a>
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
                <?php if(count($users) > 0): ?>
                <div class="table-responsive text-nowrap m-3">
                    <table class="table bg-white" id="user-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Company Website URL</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Verify</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $num = 1; ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($num); ?></td>
                                <td><?php echo e($v->name); ?></td>
                                <td><?php echo e($v->email); ?></td>
                                <td><?php echo e($v->role->name); ?></td>
                                <td><?php echo e($v->dial_code); ?> <?php echo e($v->phone_number); ?></td>
                                <td><?php echo e($v->company_website_url); ?></td>
                                <td><?php echo e(($v->status == 1) ? 'Active' : 'Deactive'); ?></td>
                                <td>
                                    <button type="button" class="btn p-0 edit-btn text-info" onclick="window.location.href=`<?php echo e(url('/lslb-admin/user')); ?>/<?php echo e($v->id); ?>/edit`"><i class="ti ti-pencil me-1"></i></button>
                                    <button type="button" class="btn p-0 delete-btn text-danger" data-bs-toggle="modal" data-bs-target="#delete-pop" onclick="$('.delete-yes-btn').attr('data-href',`<?php echo e(url('/lslb-admin/user')); ?>/<?php echo e($v->id); ?>/delete`);"><i class="ti ti-trash me-1"></i></button>
                                </td>
                                <td class="p-0 text-center"><?php echo !empty($v->email_verified_at) && $v->email_verified_at != null ?  '<i class="tf-icons ti ti-clock-check text-info"></i>' : '<i class="tf-icons ti ti-clock-cog text-danger"></i>'; ?></td>
                            </tr>
                            <?php $num++; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        var table = $('#user-tbl').DataTable();
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('lslbadmin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/lslbadmin/users.blade.php ENDPATH**/ ?>