<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo e($pageTitle); ?></div>

                <div class="vtabs customvtab m-t-10">
                    <?php echo $__env->make('sections.admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12">

                                        <div class="alert alert-info ">
                                            <h4 class="text-white">Favicon</h4>
                                            <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('messages.faviconNote'); ?>
                                        </div>

                                        <div class="form-group">
                                            <div class="radio-list">
                                                <label class="radio-inline p-0">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="active_theme" <?php if($global->active_theme == 'default'): ?> checked <?php endif; ?> id="default_theme" value="default">
                                                        <label for="default_theme"><?php echo app('translator')->get('modules.themeSettings.useDefaultTheme'); ?></label>
                                                    </div>
                                                </label>
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="active_theme" id="custom_theme" <?php if($global->active_theme == 'custom'): ?> checked <?php endif; ?> value="custom">
                                                        <label for="custom_theme"><?php echo app('translator')->get('modules.themeSettings.useCustomTheme'); ?></label>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                </div>
                              
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.enableRoundTheme'); ?></p>
                                        <div class="radio-list">
                                            <label class="radio-inline p-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" id="rounded_theme_yes" name="rounded_theme" <?php if($global->rounded_theme): ?> checked <?php endif; ?> value="1">
                                                    <label for="rounded_theme_yes"><?php echo app('translator')->get('app.yes'); ?></label>
                                                </div>
                                            </label>
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="radio" id="rounded_theme_no" name="rounded_theme" <?php if(!$global->rounded_theme): ?> checked <?php endif; ?> value="0">
                                                    <label for="rounded_theme_no"><?php echo app('translator')->get('app.no'); ?></label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-9">
                                    <div class="form-group">
                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.loginLogoBackgroundColor'); ?></p>
                                        <div class="example m-b-10">
                                            <input type="text" class="complex-colorpicker form-control" id="logo_background_color" required name="logo_background_color" value="<?php echo e($global->logo_background_color); ?>" />
                                        </div>
                                        <button class="btn btn-success btn-sm" id="save-logo-color" type="button"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
                                    </div>
                                </div>

                                

                                <div class="col-sm-12">

                                        <div id="custom-theme-options" <?php if($global->active_theme == 'default'): ?> style="display: none" <?php endif; ?>>
                                            <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']); ?>

                                            <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.adminPanelTheme'); ?></b></h3>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                        <input type="text" class="colorpicker header_color form-control" required name="theme_settings[1][header_color]" value="<?php echo e($adminTheme->header_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker sidebar_color form-control" required name="theme_settings[1][sidebar_color]" value="<?php echo e($adminTheme->sidebar_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker sidebar_text_color form-control" required name="theme_settings[1][sidebar_text_color]" value="<?php echo e($adminTheme->sidebar_text_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker link_color form-control" required name="theme_settings[1][link_color]" value="<?php echo e($adminTheme->link_color); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.employeePanelTheme'); ?></b></h3>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                        <input type="text" class="colorpicker form-control" required name="theme_settings[3][header_color]" value="<?php echo e($employeeTheme->header_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_color]" value="<?php echo e($employeeTheme->sidebar_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_text_color]" value="<?php echo e($employeeTheme->sidebar_text_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][link_color]" value="<?php echo e($employeeTheme->link_color); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.clientPanelTheme'); ?></b></h3>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                        <input type="text" class="colorpicker form-control" required name="theme_settings[4][header_color]" value="<?php echo e($clientTheme->header_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_color]" value="<?php echo e($clientTheme->sidebar_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_text_color]" value="<?php echo e($clientTheme->sidebar_text_color); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][link_color]" value="<?php echo e($clientTheme->link_color); ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.customCss'); ?></b></h3>

                                            <div class="row">
                                                <div class="col-md-12 alert alert-info">
                                                   <i class="fa fa-info-circle"></i> If you have large custom css then create following 3 files in <strong>public/css/</strong> and make changes in it.
                                                    <br>
                                                    <br>
                                                    <ol>
                                                        <li>admin-custom.css (css file for admin panel)</li>
                                                        <li>member-custom.css (css file for member panel)</li>
                                                        <li>client-custom.css (css file for client panel)</li>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for=""><?php echo app('translator')->get('app.adminPanel'); ?> <?php echo app('translator')->get('modules.themeSettings.customCss'); ?></label>
                                                        <textarea name="theme_settings[1][user_css]" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($adminTheme->user_css)): ?>/*Enter your custom css after this line*/<?php else: ?> <?php echo $adminTheme->user_css; ?> <?php endif; ?></textarea>

                                                    </div>

                                                    <div class="col-md-12 m-t-20">
                                                        <label for=""><?php echo app('translator')->get('app.employeePanel'); ?> <?php echo app('translator')->get('modules.themeSettings.customCss'); ?></label>
                                                        <textarea name="theme_settings[3][user_css]" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($employeeTheme->user_css)): ?>/*Enter your custom css after this line*/<?php else: ?> <?php echo $employeeTheme->user_css; ?> <?php endif; ?></textarea>

                                                    </div>
                                                    <div class="col-md-12 m-t-20">
                                                        <label for=""><?php echo app('translator')->get('app.clientPanel'); ?> <?php echo app('translator')->get('modules.themeSettings.customCss'); ?></label>
                                                        <textarea name="theme_settings[4][user_css]" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($clientTheme->user_css)): ?>/*Enter your custom css after this line*/<?php else: ?> <?php echo $clientTheme->user_css; ?> <?php endif; ?></textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 m-t-30">
                                                    <button class="btn btn-success" id="save-form" type="submit"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
                                                </div>
                                            </div>
                                            <?php echo Form::close(); ?>

                                        </div>

                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->



<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/ace/ace.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/theme-twilight.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/mode-css.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/jquery-ace.min.js')); ?>"></script>

<script>
    // Colorpicker

    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $('.header_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--header_color', e.target.value);
    });

    $('.sidebar_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--sidebar_color', e.target.value);
    });

    $('.sidebar_text_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--sidebar_text_color', e.target.value);
    });

    $('.link_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--link_color', e.target.value);
    });

    $('.my-code-area').ace({ theme: 'twilight', lang: 'css' })

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.store')); ?>',
            container: '#editSettings',
            data: $('#editSettings').serialize(),
            type: "POST",
            redirect: true
        })
    });

    $('input[name=active_theme]').click(function () {
        var theme = $('input[name=active_theme]:checked').val();

        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.activeTheme')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'active_theme': theme}
        })
    });

    $('input[name=rounded_theme]').click(function () {
        var theme = $('input[name=rounded_theme]:checked').val();

        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.roundedTheme')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'rounded_theme': theme}
        })
    });

    $('#save-logo-color').click(function () {
        var logo_background_color = $('#logo_background_color').val();

        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.logo_background_color')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'logo_background_color': logo_background_color}
        })
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/admin/theme-settings/edit.blade.php ENDPATH**/ ?>