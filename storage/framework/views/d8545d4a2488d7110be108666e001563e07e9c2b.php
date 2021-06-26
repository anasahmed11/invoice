<aside class="main-sidebar <?php echo e(config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')); ?>">

    
    <?php if(config('adminlte.logo_img_xl')): ?>
        <?php echo $__env->make('adminlte::partials.common.brand-logo-xl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('adminlte::partials.common.brand-logo-xs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column <?php echo e(config('adminlte.classes_sidebar_nav', '')); ?>"
                data-widget="treeview" role="menu"
                <?php if(config('adminlte.sidebar_nav_animation_speed') != 300): ?>
                data-animation-speed="<?php echo e(config('adminlte.sidebar_nav_animation_speed')); ?>"
                <?php endif; ?>
                <?php if(!config('adminlte.sidebar_nav_accordion')): ?>
                data-accordion="false"
                <?php endif; ?>>
                
                <?php if(Auth::user()->type==1): ?>
                    <li class="nav-item">
                        <a class="nav-link  <?php echo e(request()->route()->getName() === 'dashboard' ?'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                            <i class="fas fa-home "></i>

                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php echo e(request()->route()->getName() === 'customers' ?'active' : ''); ?>" href="<?php echo e(route('customers')); ?>">
                            <i class="fas fa-fw fa-user "></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php echo e(request()->route()->getName() === 'invoice-index' ?'active' : ''); ?>" href="<?php echo e(route('invoice-index')); ?>">
                            <i class="fas fa-fw fa-file-invoice-dollar "></i>
                            <p>
                                Orders
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->route()->getName() === 'users' ?'active' : ''); ?> " href="<?php echo e(route('users')); ?>">
                            <i class="fas fa-fw fa-user "></i>
                            <p>
                                users
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</aside>
<?php /**PATH E:\xampp\htdocs\dayra\resources\views/vendor/adminlte/partials/sidebar/left-sidebar.blade.php ENDPATH**/ ?>