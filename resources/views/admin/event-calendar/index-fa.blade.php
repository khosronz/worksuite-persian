@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ $pageTitle }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="#" data-toggle="modal" data-target="#my-event" class="btn btn-sm btn-success btn-outline waves-effect waves-light">
                <i class="ti-plus"></i> @lang('modules.events.addEvent')
            </a>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link href='{{asset('/fullcalendar4/packages/core/main.css')}}' rel='stylesheet' />
    <link href='{{asset('/fullcalendar4/packages/daygrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('/fullcalendar4/packages/timegrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('/fullcalendar4/packages/list/main.css')}}' rel='stylesheet' />
    <script src='{{asset('/fullcalendar4/packages/core/main.js')}}'></script>
    <script src='{{asset('/fullcalendar4/packages/core/locales-all')}}.js'></script>
    <script src='{{asset('/fullcalendar4/packages/interaction/main.js')}}'></script>
    <script src='{{asset('/fullcalendar4/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('/fullcalendar4/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('/fullcalendar4/packages/list/main.js')}}'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var initialLocaleCode = 'fa';
            var localeSelectorEl = document.getElementById('locale-selector');
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                defaultDate: '2020-02-12',
                locale: initialLocaleCode,
                buttonIcons: false, // show the prev/next text
                weekNumbers: true,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2020-02-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2020-02-07',
                        end: '2020-02-10'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2020-02-09T16:00:00'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2020-02-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2020-02-11',
                        end: '2020-02-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-02-12T10:30:00',
                        end: '2020-02-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2020-02-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-02-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2020-02-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2020-02-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2020-02-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2020-02-28'
                    }
                ]
            });

            calendar.render();

            // build the locale selector's options
            calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
                var optionEl = document.createElement('option');
                optionEl.value = localeCode;
                optionEl.selected = localeCode == initialLocaleCode;
                optionEl.innerText = localeCode;
                localeSelectorEl.appendChild(optionEl);
            });

            // when the selected option changes, dynamically change the calendar option
            localeSelectorEl.addEventListener('change', function() {
                if (this.value) {
                    calendar.setOption('locale', this.value);
                }
            });

        });

    </script>
@endpush
@push('head-style')
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #top {
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            font-size: 12px;
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }

    </style>

@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div id='top'>

                    Locales:
                    <select id='locale-selector'></select>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- .row -->

    <!-- BEGIN MODAL -->

    {{--Ajax Modal--}}

    {{--Ajax Modal Ends--}}

@endsection

@push('footer-script')

@endpush
