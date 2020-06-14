@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ $pageTitle }}
                <span class="text-info b-l p-l-10 m-l-5">{{ $totalProducts }}</span> <span class="font-12 text-muted m-l-5">@lang('app.total') @lang('app.menu.products')</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline btn-success btn-sm">@lang('app.addNew') @lang('app.menu.products') <i class="fa fa-plus" aria-hidden="true"></i></a>

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
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.dataTables.min.css')}}">
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
        #products-table_wrapper .dt-buttons{
            display: none !important;
        }
    </style>
@endpush

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="white-box">

                <div class="table-responsive">
{{--                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="products-table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>@lang('app.id')</th>--}}
{{--                            <th>@lang('app.name')</th>--}}
{{--                            <th>@lang('app.price') (@lang('app.inclusiveAllTaxes'))</th>--}}
{{--                            <th>@lang('app.purchaseAllow')</th>--}}
{{--                            <th>@lang('app.action')</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                    </table>--}}
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
    <script src="{{asset('datatables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>

    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            $('body').on('click', '.sa-params', function(){
                var id = $(this).data('user-id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted product!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm){
                    if (isConfirm) {

                        var url = "{{ route('admin.products.destroy',':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    LaravelDataTables["products-table"].draw();
                                }
                            }
                        });
                    }
                });
            });



        });

        function exportData(){
            var url = '{{ route('admin.products.export') }}';
            window.location.href = url;
        }


    </script>
@endpush
