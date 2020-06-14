@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ $pageTitle }}
                <span class="text-info b-l p-l-10 m-l-5">{{ $totalClients }}</span> <span
                        class="font-12 text-muted m-l-5"> @lang('modules.dashboard.totalClients')</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 text-right">
            <a href="{{ route('admin.clients.create') }}"
                   class="btn btn-outline btn-success btn-sm">@lang('modules.client.addNewClient') <i class="fa fa-plus"
                                                                                                      aria-hidden="true"></i></a>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.dataTables.min.css')}}">
{{--    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">--}}
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

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
@endpush

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="white-box">

                @section('filter-section')
                    <div class="row" id="ticket-filters">

                        <form action="" id="filter-form">
                            <div class="col-md-12">
                                <h5>@lang('app.selectDateRange')</h5>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" autocomplete="off" id="start-date"
                                           placeholder="@lang('app.startDate')"
                                           value=""/>
                                    <span class="input-group-addon bg-info b-0 text-white">@lang('app.to')</span>
                                    <input type="text" class="form-control" autocomplete="off" id="end-date"
                                           placeholder="@lang('app.endDate')"
                                           value=""/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>@lang('app.status')</h5>
                                    <select class="form-control" name="status" id="status" data-style="form-control">
                                        <option value="all">@lang('modules.client.all')</option>
                                        <option value="active">@lang('app.active')</option>
                                        <option value="deactive">@lang('app.deactive')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>@lang('app.client')</h5>
                                    <select class="form-control select2" name="client" id="client"
                                            data-style="form-control">
                                        <option value="all">@lang('modules.client.all')</option>
                                        @forelse($clients as $client)
                                            <option value="{{$client->id}}">{{ $client->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group p-t-10">
                                    <label class="control-label col-xs-12">&nbsp;</label>
                                    <button type="button" id="apply-filters" class="btn btn-success btn-sm col-md-6"><i
                                                class="fa fa-check"></i> @lang('app.apply')</button>
                                    <button type="button" id="reset-filters"
                                            class="btn btn-inverse col-md-5 btn-sm col-md-offset-1"><i
                                                class="fa fa-refresh"></i> @lang('app.reset')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endsection

                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('datatables/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('datatables/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{asset('datatables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>

    {!! $dataTable->scripts() !!}
    <script>
        $(".select2").select2();
        jQuery('#date-range').datepicker({
            toggleActive: true,
            format: '{{ $global->date_picker_format }}',
            language: '{{ $global->locale }}',
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

                        var url = "{{ route('admin.clients.destroy',':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

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

            var url = '{{ route('admin.clients.export', [':status', ':client']) }}';
            url = url.replace(':client', client);
            url = url.replace(':status', status);

            window.location.href = url;
        }
    </script>
@endpush
