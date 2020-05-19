<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($totalClients); ?></span> <span
                        class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.dashboard.totalClients'); ?></span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.clients.create')); ?>"
                   class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('modules.client.addNewClient'); ?> <i class="fa fa-plus"
                                                                                                      aria-hidden="true"></i></a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">

    <style>

        .dashboard-stats .white-box .list-inline {
            margin-bottom: 0;
        }

        .dashboard-stats .white-box {
            padding: 10px;
        }

        .dashboard-stats .white-box .box-title {
            font-size: 13px;
            text-transform: capitalize;
            font-weight: 300;
        }
        #clients-table_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-md-12">
            <div class="white-box">

                <?php $__env->startSection('filter-section'); ?>
                    <div class="row" id="ticket-filters">

                        <form action="" id="filter-form">
                            <div class="col-md-12">
                                <h5><?php echo app('translator')->get('app.selectDateRange'); ?></h5>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" autocomplete="off" id="start-date"
                                           placeholder="<?php echo app('translator')->get('app.startDate'); ?>"
                                           value=""/>
                                    <span class="input-group-addon bg-info b-0 text-white"><?php echo app('translator')->get('app.to'); ?></span>
                                    <input type="text" class="form-control" autocomplete="off" id="end-date"
                                           placeholder="<?php echo app('translator')->get('app.endDate'); ?>"
                                           value=""/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5><?php echo app('translator')->get('app.status'); ?></h5>
                                    <select class="form-control" name="status" id="status" data-style="form-control">
                                        <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                                        <option value="active"><?php echo app('translator')->get('app.active'); ?></option>
                                        <option value="deactive"><?php echo app('translator')->get('app.deactive'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5><?php echo app('translator')->get('app.client'); ?></h5>
                                    <select class="form-control select2" name="client" id="client"
                                            data-style="form-control">
                                        <option value="all"><?php echo app('translator')->get('modules.client.all'); ?></option>
                                        <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group p-t-10">
                                    <label class="control-label col-xs-12">&nbsp;</label>
                                    <button type="button" id="apply-filters" class="btn btn-success btn-sm col-md-6"><i
                                                class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                                    <button type="button" id="reset-filters"
                                            class="btn btn-inverse col-md-5 btn-sm col-md-offset-1"><i
                                                class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php $__env->stopSection(); ?>

                <div class="table-responsive">
                    <?php echo $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>

    <?php echo $dataTable->scripts(); ?>

    <script>
        $(".select2").select2();
        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '<?php echo e($global->date_picker_format); ?>',
            language: '<?php echo e($global->locale); ?>',
            autoclose: true
        });
        var table;
        $(function () {
            $('body').on('click', '.sa-params', function () {
                var id = $(this).data('user-id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted user!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {

                        var url = "<?php echo e(route('admin.clients.destroy',':id')); ?>";
                        url = url.replace(':id', id);

                        var token = "<?php echo e(csrf_token()); ?>";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.easyBlockUI('#clients-table');
                                    window.LaravelDataTables["clients-table"].draw();
                                    $.easyUnblockUI('#clients-table');
                                }
                            }
                        });
                    }
                });
            });

        });

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        })

        $('#apply-filters').click(function () {
            $('#clients-table').on('preXhr.dt', function (e, settings, data) {
                var startDate = $('#start-date').val();

                if (startDate == '') {
                    startDate = null;
                }

                var endDate = $('#end-date').val();

                if (endDate == '') {
                    endDate = null;
                }

                var status = $('#status').val();
                var client = $('#client').val();
                data['startDate'] = startDate;
                data['endDate'] = endDate;
                data['status'] = status;
                data['client'] = client;


            });

            $.easyBlockUI('#clients-table');
            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');

        });

        $('#reset-filters').click(function () {
            $('#filter-form')[0].reset();
            $('#status').val('all');
            $('.select2').val('all');
            $('#filter-form').find('select').select2();

            $.easyBlockUI('#clients-table');
            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');
        })

        function exportData() {

            var client = $('#client').val();
            var status = $('#status').val();

            var url = '<?php echo e(route('admin.clients.export', [':status', ':client'])); ?>';
            url = url.replace(':client', client);
            url = url.replace(':status', status);

            window.location.href = url;
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>