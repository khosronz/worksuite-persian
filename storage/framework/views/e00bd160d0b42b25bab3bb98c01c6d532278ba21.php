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
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('app.menu.projectSettings'); ?></div>

                <div class="vtabs customvtab m-t-10">

                    <?php echo $__env->make('sections.admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'PUT']); ?>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo app('translator')->get('modules.accountSettings.sendReminder'); ?>
                                                <a class="mytooltip" href="javascript:void(0)">
                                                    <i class="fa fa-info-circle"></i>
                                                    <span class="tooltip-content5">
                                                                <span class="tooltip-text3">
                                                                    <span class="tooltip-inner2">
                                                                        <?php echo app('translator')->get('modules.accountSettings.sendReminderInfo'); ?>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                </a>
                                            </label>
                                            <div class="switchery-demo">
                                                <input type="checkbox" id="send_reminder" name="send_reminder"
                                                       <?php if($projectSetting->send_reminder == 'yes'): ?> checked
                                                       <?php endif; ?> class="js-switch " data-color="#00c292"
                                                       data-secondary-color="#f96262"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row <?php if($projectSetting->send_reminder == 'no'): ?> hide <?php endif; ?>" id="send_reminder_div">
                                    <div class="col-md-12">
                                        <label><?php echo app('translator')->get('modules.projectSettings.sendNotificationsTo'); ?></label>
                                        <div class="form-group">
                                            <div id="remind_to">
                                                <div class="checkbox checkbox-info checkbox-inline m-r-10">
                                                    <input id="send_reminder_admin" name="remind_to[]" value="admins"
                                                           <?php if(in_array('admins', $projectSetting->remind_to) != false): ?> checked <?php endif; ?>
                                                           type="checkbox">
                                                    <label for="send_reminder_admin"><?php echo app('translator')->get('modules.messages.admins'); ?></label>
                                                </div>
                                                <div class="checkbox checkbox-info checkbox-inline">
                                                    <input id="send_reminder_member" name="remind_to[]" value="members"
                                                           <?php if(in_array('members', $projectSetting->remind_to) != false): ?> checked <?php endif; ?>
                                                           type="checkbox">
                                                    <label for="send_reminder_member"><?php echo app('translator')->get('modules.messages.members'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('modules.events.remindBefore'); ?></label>
                                            <input type="number" min="1" value="<?php echo e($projectSetting->remind_time); ?>" name="remind_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            
                                                
                                                
                                                
                                            
                                            <input type="text" readonly value="<?php echo e($projectSetting->remind_type); ?>" name="remind_type" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
                                    <?php echo app('translator')->get('app.update'); ?>
                                </button>

                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>

    <script>
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });

        var changeCheckbox = document.getElementById('send_reminder');

        changeCheckbox.onchange = function () {
            if (changeCheckbox.checked) {
                $('#send_reminder_div').removeClass('hide');
            } else {
                $('#send_reminder_div').addClass('hide');
            }
        };

        $('#save-form').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('admin.project-settings.update', ['1'])); ?>',
                container: '#editSettings',
                type: "POST",
                redirect: true,
                data: $('#editSettings').serialize()
            })
        });

        $('.checkbox').change(function () {
            $(this).siblings('.help-block').remove();
            $(this).parents('.form-group').removeClass('has-error');
        });

        $('#reset').click(function () {
            $('#remind_time').val('<?php echo e($projectSetting->remind_time); ?>').trigger('change');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/admin/project-settings/index.blade.php ENDPATH**/ ?>