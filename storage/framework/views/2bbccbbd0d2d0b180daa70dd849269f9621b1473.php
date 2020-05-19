<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <?php if($user->can('add_attendance')): ?>
                <a href="<?php echo e(route('member.attendances.create')); ?>"
                   class="btn btn-success btn-outline btn-sm"><?php echo app('translator')->get('modules.attendance.markAttendance'); ?> <i class="fa fa-plus"
                                                                                                aria-hidden="true"></i></a>
            <?php endif; ?>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('member.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if($user->can('add_attendance')): ?>
    <div class="row">


        <?php if($user->can('add_attendance')): ?>
            <div class="sttabs tabs-style-line col-md-12">
                <div class="white-box">
                    <nav>
                        <ul>
                            <li><a href="<?php echo e(route('member.attendances.summary')); ?>"><span><?php echo app('translator')->get('app.summary'); ?></span></a>
                            </li>
                            <li class="tab-current"><a href="<?php echo e(route('member.attendances.index')); ?>"><span><?php echo app('translator')->get('modules.attendance.attendanceByMember'); ?></span></a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- .row -->
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label"><?php echo app('translator')->get('app.selectDateRange'); ?></label>

                        <div class="input-daterange input-group" id="date-range">
                            <input type="text" class="form-control" id="start-date" placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                                   value="<?php echo e($startDate->format($global->date_format)); ?>"/>
                            <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                            <input type="text" class="form-control" id="end-date" placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                                   value="<?php echo e($endDate->format($global->date_format)); ?>"/>
                        </div>
                    </div>

                    <?php if($user->can('view_attendance')): ?>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label"><?php echo app('translator')->get('modules.timeLogs.employeeName'); ?></label>
                                <select class="select2 form-control" data-placeholder="Choose Employee" id="user_id" name="user_id">
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($userId == $employee->id): ?> selected <?php endif; ?> value="<?php echo e($employee->id); ?>"><?php echo e(ucwords($employee->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>

                        
                    <?php endif; ?>

                    <div class="col-md-3">
                        <div class="form-group m-t-25">
                            <button type="button" id="apply-filter" class="btn btn-success"><?php echo app('translator')->get('app.apply'); ?></button>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="col-md-12">

            <div class="row dashboard-stats">
                <div class="col-md-12 m-b-30">
                    <div class="white-box">
                        <div class="col-md-2 text-center">
                            <h4><span class="text-dark" id="totalWorkingDays"><?php echo e($totalWorkingDays); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.attendance.totalWorkingDays'); ?></span></h4>
                        </div>
                        <div class="col-md-2 b-l text-center">
                            <h4><span class="text-success" id="daysPresent"><?php echo e($daysPresent); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.attendance.daysPresent'); ?></span></h4>
                        </div>
                        <div class="col-md-2 b-l text-center">
                            <h4><span class="text-danger" id="daysLate"><?php echo e($daysLate); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.days'); ?> <?php echo app('translator')->get('modules.attendance.late'); ?></span></h4>
                        </div>
                        <div class="col-md-2 b-l text-center">
                            <h4><span class="text-warning" id="halfDays"><?php echo e($halfDays); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.attendance.halfDay'); ?></span></h4>
                        </div>
                        <div class="col-md-2 b-l text-center">
                            <h4><span class="text-info" id="absentDays"><?php echo e((($totalWorkingDays - $daysPresent) < 0) ? '0' : ($totalWorkingDays - $daysPresent)); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.days'); ?> <?php echo app('translator')->get('modules.attendance.absent'); ?></span></h4>
                        </div>
                        <div class="col-md-2 b-l text-center">
                            <h4><span class="text-primary" id="holidayDays"><?php echo e($holidays); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.attendance.holidays'); ?></span></h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-12">
            <div class="white-box">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('app.date'); ?></th>
                            <th><?php echo app('translator')->get('app.status'); ?></th>
                            <th><?php echo app('translator')->get('modules.attendance.clock_in'); ?></th>
                            <th><?php echo app('translator')->get('modules.attendance.clock_out'); ?></th>
                            <th><?php echo app('translator')->get('app.others'); ?></th>
                        </tr>
                        </thead>
                        <tbody id="attendanceData">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>

<script>
    var startDate = '<?php echo e($startDate->format('Y-m-d')); ?>';
    var endDate = '<?php echo e($endDate->format('Y-m-d')); ?>';

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        cancelClass: 'btn-inverse',
        "locale": {
            "applyLabel": "<?php echo e(__('app.apply')); ?>",
            "cancelLabel": "<?php echo e(__('app.cancel')); ?>",
            "daysOfWeek": [
                "<?php echo e(__('app.su')); ?>",
                "<?php echo e(__('app.mo')); ?>",
                "<?php echo e(__('app.tu')); ?>",
                "<?php echo e(__('app.we')); ?>",
                "<?php echo e(__('app.th')); ?>",
                "<?php echo e(__('app.fr')); ?>",
                "<?php echo e(__('app.sa')); ?>"
            ],
            "monthNames": [
                "<?php echo e(__('app.january')); ?>",
                "<?php echo e(__('app.february')); ?>",
                "<?php echo e(__('app.march')); ?>",
                "<?php echo e(__('app.april')); ?>",
                "<?php echo e(__('app.may')); ?>",
                "<?php echo e(__('app.june')); ?>",
                "<?php echo e(__('app.july')); ?>",
                "<?php echo e(__('app.august')); ?>",
                "<?php echo e(__('app.september')); ?>",
                "<?php echo e(__('app.october')); ?>",
                "<?php echo e(__('app.november')); ?>",
                "<?php echo e(__('app.december')); ?>",
            ]
        }
    })

    // $('.input-daterange-datepicker').on('apply.daterangepicker', function (ev, picker) {
    //     startDate = picker.startDate.format('YYYY-MM-DD');
    //     endDate = picker.endDate.format('YYYY-MM-DD');
    //     showTable();
    // });

    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: '<?php echo e($global->date_picker_format); ?>',
        language: '<?php echo e($global->locale); ?>',
        autoclose: true
    });

    $('#apply-filter').click(function () {
       showTable();
    });

    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });

    var table;

    function showTable() {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();

        var userId = $('#user_id').val();
        if (typeof userId === 'undefined') {
            userId = '<?php echo e($userId); ?>';
        }

        var token = "<?php echo e(csrf_token()); ?>";

        //refresh counts
        var url = '<?php echo route('member.attendances.refreshCount'); ?>';

        $.easyAjax({
            type: 'POST',
            data: {
                '_token': token,
                startDate: startDate,
                endDate: endDate,
                userId: userId
            },
            url: url,
            success: function (response) {
                $('#daysPresent').html(response.daysPresent);
                $('#daysLate').html(response.daysLate);
                $('#halfDays').html(response.halfDays);
                $('#totalWorkingDays').html(response.totalWorkingDays);
                $('#absentDays').html(response.absentDays);
                $('#holidayDays').html(response.holidays);
                initConter();
            }
        });

        //refresh datatable
        var url2 = '<?php echo route('member.attendances.employeeData'); ?>';

        $.easyAjax({
            type: 'POST',
            url: url2,
            data: {
                '_token': token,
                startDate: startDate,
                endDate: endDate,
                userId: userId
            },
            success: function (response) {
                $('#attendanceData').html(response.data);
            }
        });
    }

    $('#attendanceData').on('click', '.delete-attendance', function(){
        var id = $(this).data('attendance-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the deleted attendance record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('member.attendances.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });


    function initConter() {
        $(".counter").counterUp({
            delay: 100,
            time: 1200
        });
    }

    showTable();

</script>
<script>
    $('#clock-in').click(function () {
        var workingFrom = $('#working_from').val();

        var token = "<?php echo e(csrf_token()); ?>";

        $.easyAjax({
            url: '<?php echo e(route('member.attendances.store')); ?>',
            type: "POST",
            data: {
                working_from: workingFrom,
                _token: token
            },
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        })
    })

    <?php if(!is_null($currenntClockIn)): ?>
    $('#clock-out').click(function () {
        var token = "<?php echo e(csrf_token()); ?>";

        $.easyAjax({
            url: '<?php echo e(route('member.attendances.update', $currenntClockIn->id)); ?>',
            type: "PUT",
            data: {
                _token: token
            },
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        })
    })
    <?php endif; ?>

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/member/attendance/index.blade.php ENDPATH**/ ?>