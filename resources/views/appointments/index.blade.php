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
            <a href="{{ route('appointments.index', $userProfile) }}">
                {{ $userProfile->name }}
            </a>
        </p>
    @endforeach
@endsection

@section('content')

    <div id="appointmentsCalendar"></div>

    @include('appointments.partials._appModal')
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.17/moment-timezone-with-data.min.js"></script>
    <script src="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar-3.9.0/gcal.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>

    <script>

        var calendar = $('#appointmentsCalendar'),
            profileId = "{{ $profile->id }}",
            profileName = "{{ $profile->name }}",
            appointmentsUrl = "{{ route('appointments.index', $profile) }}",
            profileWorkdays = {{ $profile->workdays->pluck('id') }},
            profilesAppInt20 = "{{ \App\Profile::appInterval(20)->pluck('id') }}",
            appModal = $("#appModal"),
            appForm = $("#appForm"),
            profileField = $("#profile_id"),
            dateField = $("#app_date"),
            startField = $("#app_start"),
            genderRadio = 'gender',
            fNameField = $("#f_name"),
            lNameField = $("#l_name"),
            birthdayField = $("#birthday"),
            phoneField = $("#phone"),
            dateFormat = "YYYY-MM-DD",
            timeFormat = "HH:mm",
            appFormFields = ['profile_id','app_date', 'app_start', 'gender', 'f_name', 'l_name', 'birthday', 'phone']

        appModal.emptyModal(appFormFields)
        appModal.setAutofocus('profileId')

        calendar.fullCalendar({
            header: {
                left: 'prev, next, today',
                right: 'month, agendaWeek, agendaDay, list',
                center: 'title',
            },
            defaultView: profileId ? 'agendaWeek' : 'month',
            fixedWeekCount:false,
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: true,  // out of the current view
            allDaySlot:true,
            slotLabelFormat: 'H:mm', // 16:00
            slotDuration: slotDuration(profileId, profilesAppInt20, 20), //
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
            events:  {
                url: appointmentsUrl,
                textColor: 'black',
                timeFormat: 'H:mm'
            },
            //transform event attributes into event object attributes
            eventDataTransform: function(event) {
                event.title = event.patient.f_name + ' ' + event.patient.l_name
                event.color = event.profile.color
                return event;
            },
            //override default "02:00:00" when the event end is not defined
            defaultTimedEventDuration: slotDuration(profileId, profilesAppInt20, 20),
            dayRender: function (date, cell) {

                var day = moment(date).day()

                if($.inArray(day, profileWorkdays) !== -1) {
                    cell.css("background-color", "#E3FCEC");
                }
            },
            select: function(start, end, jsEvent, view){

                // Appointment modal
                appModal.modal('show')

                $(".modal-title i").addClass('fa-calendar')
                $(".modal-title span").text('New appointment')
                $(".app-button").addClass('bg-indigo-dark text-white').text('Create appointment').attr('id', 'createApp')

                // Appointment form
                var appDate = eventDate(start, dateFormat)
                var appStart = eventStart(view, start, timeFormat)

                dateField.val(appDate);
                startField.val(appStart);
                profileField.val(profileName);
            }
        })


        // Store appointment
        $(document).on('click', '#createApp', function() {

            var appointment = {
                profile_id: getProfileId(profileId, profileField),
                app_date: dateField.val(),
                app_start: startField.val(),
                gender: getCheckedValue(appForm, genderRadio),
                f_name: fNameField.val(),
                l_name: lNameField.val(),
                birthday: birthdayField.val(),
                phone: phoneField.val(),
            }

            $.ajax({
                url: appointmentsUrl,
                type: 'POST',
                data: appointment,
                success: function(response)
                {
                    successResponse(appModal, response.message)

                    calendar.fullCalendar('renderEvent', appointment)
                    calendar.fullCalendar('refetchEvents');
                },
                error: function(response)
                {
                    errorResponse(response.responseJSON.errors, appModal)
                }
            })
        })
    </script>
@endsection