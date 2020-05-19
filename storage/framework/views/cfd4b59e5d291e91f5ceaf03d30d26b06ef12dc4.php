<?php $__env->startSection('other-section'); ?>
<ul class="nav tabs-vertical">
    <?php $__currentLoopData = $subMenuSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(in_array($menu['module'], $modules) || $menu['module'] == 'visibleToAll'): ?>
            <?php if($menu['menu_name'] != 'updates'): ?>
                <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == $menu['route']): ?> active <?php endif; ?>">
                    <a href="<?php echo e(isset($menu['children']) ? route($menu['children'][0]['route']) :  route($menu['route'])); ?>"><?php echo app('translator')->get($menu['translate_name']); ?></a></li>
            <?php else: ?>
                <?php if($global->system_update == 1): ?>
                    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == $menu['route']): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route($menu['route'])); ?>"><?php echo app('translator')->get($menu['translate_name']); ?></a></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $worksuitePlugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(View::exists(strtolower($item).'::sections.admin_setting_menu')): ?>
            <?php echo $__env->make(strtolower($item).'::sections.admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <li><a href="https://envato-froiden.freshdesk.com/a/solutions/" target="_blank" class="waves-effect"><span class="hide-menu"> <?php echo app('translator')->get('app.menu.help'); ?></span></a>
    </li>
</ul>

<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    var screenWidth = $(window).width();
    if(screenWidth <= 768){

        $('.tabs-vertical').each(function() {
            var list = $(this), select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('settings_dropdown form-control');

            $('>li a', this).each(function() {
                var target = $(this).attr('target'),
                    option = $(document.createElement('option'))
                        .appendTo(select)
                        .val(this.href)
                        .html($(this).html())
                        .click(function(){
                            if(target==='_blank') {
                                window.open($(this).val());
                            }
                            else {
                                window.location.href = $(this).val();
                            }
                        });

                if(window.location.href == option.val()){
                    option.attr('selected', 'selected');
                }
            });
            list.remove();
            $('.filter-section').show()
        });

        $('.settings_dropdown').change(function () {
            window.location.href = $(this).val();
        })

    }
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\wamp64\www\worksuite\resources\views/sections/admin_setting_menu.blade.php ENDPATH**/ ?>