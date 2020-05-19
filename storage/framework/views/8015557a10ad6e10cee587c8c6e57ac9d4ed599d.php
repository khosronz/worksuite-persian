<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="<?php echo e(route('admin.ticket-agents.index')); ?>" class="btn btn-sm btn-inverse btn-outline"><i class="fa fa-gear"></i> <?php echo app('translator')->get('app.menu.ticketSettings'); ?></a>
            <a href="<?php echo e(route('admin.tickets.create')); ?>"
                               class="btn btn-success btn-outline btn-sm"><?php echo app('translator')->get('modules.tickets.addTicket'); ?> <i class="fa fa-plus"
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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <style>
        #ticket-table_wrapper .dt-buttons{
            display: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('filter-section'); ?>
<div class="row" id="ticket-filters">

    <form action="" id="filter-form">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label"><?php echo app('translator')->get('modules.tickets.agent'); ?></label>
            <select class="form-control select2" name="agent_id" id="agent_id" data-style="form-control">
                <option value=""><?php echo app('translator')->get('modules.tickets.nofilter'); ?></option>
                <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(count($group->enabled_agents) > 0): ?>
                        <optgroup label="<?php echo e(ucwords($group->group_name)); ?>">
                            <?php $__currentLoopData = $group->enabled_agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($agent->user->id); ?>"><?php echo e(ucwords($agent->user->name).' ['.$agent->user->email.']'); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option value=""><?php echo app('translator')->get('messages.noGroupAdded'); ?></option>
                <?php endif; ?>
            </select>
        </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo app('translator')->get('app.status'); ?></label>
                <select class="form-control select2" name="status" id="status" data-style="form-control">
                    <option value=""><?php echo app('translator')->get('modules.tickets.nofilter'); ?></option>
                    <option value="open"><?php echo app('translator')->get('modules.tickets.totalOpenTickets'); ?></option>
                    <option value="pending"><?php echo app('translator')->get('modules.tickets.totalPendingTickets'); ?></option>
                    <option value="resolved"><?php echo app('translator')->get('modules.tickets.totalResolvedTickets'); ?></option>
                    <option value="closed"><?php echo app('translator')->get('modules.tickets.totalClosedTickets'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo app('translator')->get('modules.tasks.priority'); ?></label>
                <select class="form-control select2" name="priority" id="priority" data-style="form-control">
                    <option value=""><?php echo app('translator')->get('modules.tickets.nofilter'); ?></option>
                    <option value="low"><?php echo app('translator')->get('modules.tasks.low'); ?></option>
                    <option value="medium"><?php echo app('translator')->get('modules.tasks.medium'); ?></option>
                    <option value="high"><?php echo app('translator')->get('modules.tasks.high'); ?></option>
                    <option value="urgent"><?php echo app('translator')->get('modules.tickets.urgent'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo app('translator')->get('modules.tickets.channelName'); ?></label>
                <select class="form-control select2" name="channel_id" id="channel_id" data-style="form-control">
                    <option value=""><?php echo app('translator')->get('modules.tickets.nofilter'); ?></option>
                    <?php $__empty_1 = true; $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option value="<?php echo e($channel->id); ?>"><?php echo e(ucwords($channel->channel_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <option value=""><?php echo app('translator')->get('messages.noTicketChannelAdded'); ?></option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo app('translator')->get('modules.invoices.type'); ?></label>
                <select class="form-control select2" name="type_id" id="type_id" data-style="form-control">
                    <option value=""><?php echo app('translator')->get('modules.tickets.nofilter'); ?></option>
                    <?php $__empty_1 = true; $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e(ucwords($type->type)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <option value=""><?php echo app('translator')->get('messages.noTicketTypeAdded'); ?></option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label col-xs-12">&nbsp;</label>
                <button type="button" id="apply-filters" class="btn btn-success col-md-6"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-md-12">
            <div class="white-box p-b-0 m-b-0">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label"><?php echo app('translator')->get('app.selectDateRange'); ?></label>

                        <div class="form-group">
                            <input class="form-control input-daterange-datepicker" type="text" name="daterange"
                                   value="<?php echo e($startDate.' - '.$endDate); ?>"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><i class="ti-ticket"></i> <?php echo app('translator')->get('app.menu.tickets'); ?></a></li>
                    <li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><i class="icon-graph"></i>  <?php echo app('translator')->get('modules.tickets.ticketTrendGraph'); ?></a></li>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="home1">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row dashboard-stats m-b-20">
                                <div class="col-md-12">
                                    <div class="white-box">
                                        <div class="col-md-4 col-sm-6">
                                            <h4>
                                                <span class="text-dark" id="totalTickets">0</span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.totalTickets'); ?></span>
                                                <a class="mytooltip font-12" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.tickets.totalTicketInfo'); ?></span></span></span></a>
                                            </h4>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h4>
                                                <span class="text-success" id="closedTickets">0</span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.totalClosedTickets'); ?></span>
                                                <a class="mytooltip font-12" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.tickets.closedTicketInfo'); ?></span></span></span></a>
                                            </h4>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h4>
                                                <span class="text-danger" id="openTickets">0</span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.totalOpenTickets'); ?></span>
                                                <a class="mytooltip font-12" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.tickets.openTicketInfo'); ?></span></span></span></a>
                                            </h4>
                                        </div>
        
                                        <div class="col-md-4 col-sm-6">
                                            <h4>
                                                <span class="text-warning" id="pendingTickets">0</span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.totalPendingTickets'); ?></span>
                                                <a class="mytooltip font-12" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.tickets.pendingTicketInfo'); ?></span></span></span></a>
                                            </h4>
                                        </div>
        
                                        <div class="col-md-4 col-sm-6">
                                            <h4>
                                                <span class="text-info" id="resolvedTickets">0</span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.totalResolvedTickets'); ?></span>
                                                <a class="mytooltip font-12" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php echo app('translator')->get('modules.tickets.resolvedTicketInfo'); ?></span></span></span></a>
                                            </h4>
                                        </div>
        
                                    </div>
                                </div>
        
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <div class="table-responsive">
                                            <?php echo $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

        
                        </div>
                        
        
                    </div>
        
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile1">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box p-t-10 p-b-10">
                                <ul class="list-inline text-right">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #4c5667;"></i><?php echo app('translator')->get('modules.invoices.total'); ?></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5475ed;"></i><?php echo app('translator')->get('modules.issues.resolved'); ?></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #f1c411;"></i><?php echo app('translator')->get('modules.tickets.totalUnresolvedTickets'); ?></h5>
                                    </li>
                                </ul>
                                <div id="morris-area-chart" style="height: 225px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('js/datatables/buttons.server-side.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

<?php echo $dataTable->scripts(); ?>

<script>
     $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });
    
    var startDate = '<?php echo e(\Carbon\Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-m-d')); ?>';
    var endDate = '<?php echo e(\Carbon\Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-m-d')); ?>';

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
                "<?php echo e(__('app.december')); ?>"
            ]
        }
    })

    $('.input-daterange-datepicker').on('apply.daterangepicker', function (ev, picker) {
        startDate = picker.startDate.format('YYYY-MM-DD');
        endDate = picker.endDate.format('YYYY-MM-DD');
        showTable();
    });

    $('.toggle-filter').click(function () {
        $('#ticket-filters').toggle('slide');
    })

    $('#ticket-table').on('preXhr.dt', function (e, settings, data) {
        var agentId = $('#agent_id').val();
        if (agentId == "") {
            agentId = 0;
        }

        var status = $('#status').val();
        if (status == "") {
            status = 0;
        }

        var priority = $('#priority').val();
        if (priority == "") {
            priority = 0;
        }

        var channelId = $('#channel_id').val();
        if (channelId == "") {
            channelId = 0;
        }

        var typeId = $('#type_id').val();
        if (typeId == "") {
            typeId = 0;
        }

        data['startDate'] = startDate;
        data['endDate'] = endDate;
        data['agentId'] = agentId;
        data['priority'] = priority;
        data['channelId'] = channelId;
        data['typeId'] = typeId;
        data['status'] = status;
    });

    function ticketChart(chartData){
        Morris.Area({
            element: 'morris-area-chart',
            data: chartData,
            xkey: 'date',
            ykeys: ['total', 'resolved', 'unresolved'],
            labels: ['Total', 'Resolved', 'Unresolved'],
            pointSize: 3,
            fillOpacity: 0.3,
            pointStrokeColors: ['#4c5667', '#5475ed', '#f1c411'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#4c5667', '#5475ed', '#f1c411'],
            resize: true

        });
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href") // activated tab

        switch (target) {
            case "#home1":
            $(window).trigger('resize');
            break;
            case "#profile1":
            $(window).trigger('resize');
            break;
        }
    });

    var table;

    function showTable() {

        var agentId = $('#agent_id').val();
        if (agentId == "") {
            agentId = 0;
        }

        var status = $('#status').val();
        if (status == "") {
            status = 0;
        }

        var priority = $('#priority').val();
        if (priority == "") {
            priority = 0;
        }

        var channelId = $('#channel_id').val();
        if (channelId == "") {
            channelId = 0;
        }

        var typeId = $('#type_id').val();
        if (typeId == "") {
            typeId = 0;
        }


        //refresh counts and chart
        var url = '<?php echo route('admin.tickets.refreshCount', [':startDate', ':endDate', ':agentId', ':status', ':priority', ':channelId', ':typeId']); ?>';
        url = url.replace(':startDate', startDate);
        url = url.replace(':endDate', endDate);
        url = url.replace(':agentId', agentId);
        url = url.replace(':status', status);
        url = url.replace(':priority', priority);
        url = url.replace(':channelId', channelId);
        url = url.replace(':typeId', typeId);

        $.easyAjax({
            type: 'GET',
            url: url,
            success: function (response) {
                $('#totalTickets').html(response.totalTickets);
                $('#closedTickets').html(response.closedTickets);
                $('#openTickets').html(response.openTickets);
                $('#pendingTickets').html(response.pendingTickets);
                $('#resolvedTickets').html(response.resolvedTickets);
                initConter();

                $('#morris-area-chart').empty();
                ticketChart(JSON.parse(response.chartData));
            }
        });

        window.LaravelDataTables["ticket-table"].draw();
    }

    $('#apply-filters').click(function () {
        showTable();
    });

    $('#reset-filters').click(function () {
        $('#filter-form')[0].reset();
        $('#filter-form').find('select').selectpicker('render');
        showTable();
    })


    $('body').on('click', '.sa-params', function () {
        var id = $(this).data('ticket-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the deleted ticket!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('admin.tickets.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.LaravelDataTables["ticket-table"].draw();
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

    function exportData(){

        var agentId = $('#agent_id').val();
        if (agentId == "") {
            agentId = 0;
        }

        var status = $('#status').val();
        if (status == "") {
            status = 0;
        }

        var priority = $('#priority').val();
        if (priority == "") {
            priority = 0;
        }

        var channelId = $('#channel_id').val();
        if (channelId == "") {
            channelId = 0;
        }

        var typeId = $('#type_id').val();
        if (typeId == "") {
            typeId = 0;
        }


        //refresh counts and chart
        var url = '<?php echo route('admin.tickets.export', [':startDate', ':endDate', ':agentId', ':status', ':priority', ':channelId', ':typeId']); ?>';
        url = url.replace(':startDate', startDate);
        url = url.replace(':endDate', endDate);
        url = url.replace(':agentId', agentId);
        url = url.replace(':status', status);
        url = url.replace(':priority', priority);
        url = url.replace(':channelId', channelId);
        url = url.replace(':typeId', typeId);

        window.location.href = url;
    }

    showTable();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>