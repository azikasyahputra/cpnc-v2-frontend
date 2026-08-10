<?php
    $from = $paginator->firstItem();
    $to = $paginator->lastItem();
    $total = $paginator->total();
    $lastIdx = count($columns) - 1;
    $filterable = array_values(array_filter($columns, function ($col) {
        return isset($col['filter']);
    }));
?>
<form method="GET" action="<?php echo e(request()->url()); ?>">

    <?php if(count($filterable) > 0): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3">
                <?php $__currentLoopData = $filterable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label mb-1"><?php echo e($column['label']); ?></label>
                        <input type="text" name="filter[<?php echo e($column['name']); ?>]" value="<?php echo e($filters[$column['name']] ?? ''); ?>" class="form-control form-control-sm" placeholder="<?php echo e($column['label']); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-2 col-sm-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bx bx-search me-1"></i>Search</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-1">
                        <small class="text-dark">Show</small>
                        <select name="per_page" class="form-select form-select-sm" style="width:80px;" onchange="this.form.submit()">
                            <?php $__currentLoopData = $per_page_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php if((int) $paginator->perPage() === (int) $option): ?> selected <?php endif; ?>><?php echo e($option); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__currentLoopData = $toolbar_buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($button['url']); ?>" class="btn btn-sm <?php echo e($button['class'] ?? 'btn-secondary'); ?>"><?php echo $button['label']; ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="d-flex align-items-center gap-3 ms-md-auto">
                    <?php if($add_button): ?>
                        <a href="<?php echo e($add_button['url']); ?>" class="btn btn-sm btn-primary">
                            <i class="bx bx-plus me-1"></i><?php echo e($add_button['label']); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="<?php echo e($id); ?>">
                <thead style="background-color: #696cff;">
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="text-white" style="font-weight:600;font-size:12px;<?php echo e(isset($column['width']) ? 'width:'.$column['width'].';' : ''); ?><?php echo e($i === $lastIdx && $column['name'] === 'Action' ? 'position:sticky;right:0;background:#696cff;box-shadow:inset 0 0 0 9999px #696cff;z-index:2;' : ''); ?>">
                                <?php if(! empty($column['sortable']) && isset($sort_urls[$column['name']])): ?>
                                    <a href="<?php echo e($sort_urls[$column['name']]); ?>" class="text-white"><?php echo e($column['label']); ?>

                                        <?php if($sort === $column['name']): ?>
                                            <i class="bx bx-sort-<?php echo e($dir === 'desc' ? 'desc' : 'asc'); ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo e($column['label']); ?>

                                <?php endif; ?>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $__empty_1 = true; $__currentLoopData = $paginator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td <?php if($i === $lastIdx && $column['name'] === 'Action'): ?> style="position:sticky;right:0;background:#fff;z-index:1;" <?php endif; ?>>
                                    <?php if(! empty($column['html'])): ?>
                                        <?php echo $column['html']($row); ?>

                                    <?php else: ?>
                                        <?php echo e($row->{$column['name']} ?? ''); ?>

                                    <?php endif; ?>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(count($columns)); ?>" class="text-center py-5 text-muted">No data found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($paginator->hasPages() || $from): ?>
        <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <nav aria-label="Page navigation">
                <?php echo e($paginator->links()); ?>

            </nav>
            <?php if($from): ?>
                <small class="text-muted">Showing <?php echo e($from); ?> - <?php echo e($to); ?> of <?php echo e($total); ?></small>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/layout/partials/grid_table.blade.php ENDPATH**/ ?>