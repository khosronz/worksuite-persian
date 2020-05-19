<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <?php if($user->can('add_projects')): ?>
                <a href="<?php echo e(route('member.project-template.index')); ?>"  class="btn btn-outline btn-primary btn-sm"><?php echo app('translator')->get('app.menu.addProjectTemplate'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
                <a href="<?php echo e(route('member.projects.create')); ?>" class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('modules.projects.addNewProject'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

<style>
        .custom-action a {
            margin-right: 15px;
            margin-bottom: 15px;
        }
        .custom-action a:last-child {
            margin-right: 0px;
            float: right;
        }

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

        @media  all and (max-width: 767px) {
            .custom-action a {
                margin-right: 0px;
            }

            .custom-action a:last-child {
                margin-right: 0px;
                float: none;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row dashboard-stats">
        <div class="col-md-12 m-t-20">
            <div class="white-box">
                <div class="col-md-4">
                    <h4><span class="text-dark" id="totalWorkingDays"><?php echo e($totalProjects); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.dashboard.totalProjects'); ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><span class="text-danger" id="daysPresent"><?php echo e($overdueProjects); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.overDueProjects'); ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><span class="text-warning" id="daysLate"><?php echo e($notStartedProjects); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.notStarted'); ?> <?php echo app('translator')->get('app.menu.projects'); ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><span class="text-success" id="halfDays"><?php echo e($finishedProjects); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('modules.tickets.completedProjects'); ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><span class="text-info" id="absentDays"><?php echo e($inProcessProjects); ?></span> <span class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.inProgress'); ?> <?php echo app('translator')->get('app.menu.projects'); ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><span class="text-primary" id="holidayDays"><?php echo e($canceledProjects); ?></span> <span class="font-12 text-muted m-l-5"><?php echo app('translator')->get('app.canceled'); ?> <?php echo app('translator')->get('app.menu.projects'); ?></span></h4>
                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php if($user->can('view_projects')): ?>
                    <?php $__env->startSection('filter-section'); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"><?php echo app('translator')->get('app.menu.projects'); ?> <?php echo app('translator')->get('app.status'); ?></label>
                                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.menu.projects'); ?> <?php echo app('translator')->get('app.status'); ?>" id="status">
                                            <option selected value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                            <option
                                                value="not started"><?php echo app('translator')->get('app.notStarted'); ?>
                                            </option>
                                            <option
                                                value="in progress"><?php echo app('translator')->get('app.inProgress'); ?>
                                            </option>
                                            <option
                                                value="on hold"><?php echo app('translator')->get('app.onHold'); ?>
                                            </option>
                                            <option
                                                value="canceled"><?php echo app('translator')->get('app.canceled'); ?>
                                            </option>
                                            <option
                                                value="finished"><?php echo app('translator')->get('app.finished'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"><?php echo app('translator')->get('app.clientName'); ?></label>
                                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.clientName'); ?>" id="client_id">
                                            <option selected value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo app('translator')->get('app.menu.teams'); ?></label>
                                <select class="select2 form-control" data-placeholder="<?php echo app('translator')->get('app.menu.teams'); ?>" id="team_id">
                                    <option selected value="all"><?php echo app('translator')->get('app.all'); ?></option>
                                    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($team->id); ?>"><?php echo e($team->team_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php $__env->stopSection(); ?>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="project-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('modules.projects.projectName'); ?></th>
                            <th><?php echo app('translator')->get('modules.projects.projectMembers'); ?></th>
                            <th><?php echo app('translator')->get('modules.projects.deadline'); ?></th>
                            <th><?php echo app('translator')->get('app.completion'); ?></th>
                            <th><?php echo app('translator')->get('app.status'); ?></th>
                            <th><?php echo app('translator')->get('app.action'); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

    
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script>
    var table;
    $(".select2").select2({
        formatNoMatches: function () {
            return "<?php echo e(__('messages.noRecordFound')); ?>";
        }
    });
    $('.select2').val('all');
    $(function() {
        showData();
        $('body').on('click', '.sa-params', function(){
            var id = $(this).data('user-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover the deleted project!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    var url = "<?php echo e(route('member.projects.destroy',':id')); ?>";
                    url = url.replace(':id', id);

                    var token = "<?php echo e(csrf_token()); ?>";

                    $.easyAjax({
                        type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        });

        $('#createProject').click(function(){
            var url = '<?php echo e(route('admin.projectCategory.create')); ?>';
            $('#modelHeading').html('Manage Project Category');
            $.ajaxModal('#projectCategoryModal',url);
        })

    });

    function showData(){
        var status = "";
        var clientID = "";
        var teamID = "";

        if($('#status').length){
            status = $('#status').val();
        }

        if($('#client_id').length){
            clientID = $('#client_id').val();
        }

        if($('#team_id').length){
            teamID = $('#team_id').val();
        }

        var searchQuery = "?status="+status+"&client_id="+clientID+"&team_id="+teamID;

        table = $('#project-table').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: '<?php echo route('member.projects.data'); ?>'+searchQuery,
            deferRender: true,
            language: {
                "url": "<?php echo __("app.datatable") ?>"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'project_name', name: 'project_name'},
                { data: 'members', name: 'members' },
                { data: 'deadline', name: 'deadline' },
                { data: 'completion_percent', name: 'completion_percent' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]
        });
    }

    $('#status').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#client_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#team_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.member-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\worksuite\resources\views/member/projects/index.blade.php ENDPATH**/ ?>