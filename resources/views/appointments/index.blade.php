@extends('layouts.app')

@section('title', '| New Appointment')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.print.min.css') }}" type="media" >
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}">

    <style>
        .fc-view-container { background: #fff }
    </style>
@endsection

@section('side')

    <h4 class="text-uppercase mb-4 mt-1">Doctors</h4>
    @foreach ($profiles as $userProfile)
        <p>
            <a href="{{ route('appointments.index', $userProfile->user->id) }}">
                {{ $userProfile->name }}
            </a>
        </p>
    @endforeach
@endsection

@section('content')

    <div id="appointmentsCalendar"></div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.17/moment-timezone-with-data.min.js"></script>
    {{-- <script src="{{ asset('vendor/moment-2.18.1/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/moment-2.18.1/moment-timezone-with-data.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar-3.9.0/gcal.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>

    <script>
        var calendar = $('#appointmentsCalendar')

        var profileId = "{{ $profile->id }}",
        appointmentsUrl = '/appointments/' + profileId;

        calendar.fullCalendar({
            header: {
                left: 'prev, next, today',
                right: 'month, agendaWeek, agendaDay, list',
                center: 'title',
            },
            defaultView: profileId ? 'agendaWeek' : 'month',
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: true,
            slotDuration: '00:30:00',
            firstDay: 1,
            navLinks: true,
            selectHelper: true,
            editable: true,
            selectable: true,
            businessHours: [
                {
                    dow: [ 1, 2, 3, 4, 5 ],
                    start: '09:00',
                    end: '20:00'
                },
                {
                    dow: [ 6 ],
                    start: '10:00',
                    end: '15:00'
                }
            ],
            minTime: "09:00",
            maxTime: "20:00",
            eventLimit: true,
            timezone: 'Europe/Belgrade',
            eventSources: [
                {
                    url : appointmentsUrl,
                    color: '#ffae00',
                    textColor: 'black'
                }
            ]
        })

    </script>
@endsection