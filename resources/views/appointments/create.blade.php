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
    @foreach ($profiles as $profile)
        <p>
            <a href="#">
                {{ $profile->name }}
            </a>
        </p>
    @endforeach
@endsection

@section('content')

    <div id="appointmentsCalendar"></div>

    {{-- <form action="{{ route('appointments.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label for="profile">Doctor</label>
            <select name="profile_id" id="profile_id" class="form-control">
                <option>Select a doctor</option>
                @foreach ($profiles as $profile)
                    <option value="profile_id">
                        {{ $profile->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control" placeholder="yyyy-mm-dd" value="{{ old('date') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" name="time" id="time" class="form-control" placeholder="hh:mm" value="{{ old('time') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="f_name">First name</label>
                    <input type="text" name="f_name" id="f_name" class="form-control" placeholder="Enter first name" value="{{ old('f_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="l_name">Last name</label>
                    <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter last name" value="{{ old('l_name') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input type="text" name="birthday" id="birthday" class="form-control" placeholder="yyyy-mm-dd" value="{{ old('birthday') }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="gender">Gender</label>
                <div class="flex mt-2">
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="M" />
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="F" />
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="123456" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-warning">Schedule appointment</button>
        </div>
    </form> --}}
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

        calendar.fullCalendar({
            header: {
                left: 'prev, next, today',
                right: 'month, agendaWeek, agendaDay, list',
                center: 'title',
            },
            handleWindowResize: true,
            firstDay: 1,
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
            minTime: "09:00:00",
            maxTime: "20:00:00",
            eventLimit: true
        })
    </script>
@endsection