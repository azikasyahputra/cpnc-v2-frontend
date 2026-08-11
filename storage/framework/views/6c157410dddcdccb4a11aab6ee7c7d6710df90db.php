<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit User</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Pengaturan</a></li>
                              <li><a href="<?php echo e(URL::route('user')); ?>">User</a></li>
                              <li class="active">Edit User</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 col-sm-12 col-12">
        <div class="card">
            <form action="<?php echo e(URL::route('usersaveedit')); ?>" method="post" class="form-horizontal">
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-body ">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id_user" value="<?php echo e($data->id); ?>"/>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="username" class=" form-label">Username *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="username" class="form-control" name="username" value="<?php echo e($data->username); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="nama" class=" form-label">Nama *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" class="form-control" name="nama" value="<?php echo e($data->nama); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="email" class=" form-label">Email *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email" class="form-control" name="email" value="<?php echo e($data->email); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="role" class=" form-label">Role *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="role" name="role" class="form-control" required>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->nama_role); ?>" <?php echo e($data->role == $role->nama_role ? 'selected' : ''); ?>><?php echo e($role->nama_role); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="password" class=" form-label">Password</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diganti" /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(URL::route('user')); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc-v2-frontend/resources/views/user/edit.blade.php ENDPATH**/ ?>