@extends('layouts.app')

@section('title', '| New Appointment')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}">

@endsection

@section('side')
    <h4 class="text-uppercase mb-4 mt-1">Doctors</h4>
    @foreach ($profiles as $userProfile)
        <p>
            <a href="{{ route('appointments.index', $userProfile->id) }}">
                {{ $userProfile->name }}
            </a>
        </p>
    @endforeach
@endsection

@section('content')
    @include('errors._list')

    <form action="{{ route('appointments.store', $profile) }}" method="POST">
        <p class="text-uppercase mb-2">APPOINTMENT DETAILS</p>

        @csrf

        <div class="form-group">
            <label for="profile_id">Doctor</label>
            <input type="text" name="profile_id" id="profile_id" class="form-control rounded-none profile_id" value="{{ $profile->id }}" />

            <span class="invalid-feedback profile_id"></span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="app_date">Date</label>
                    <input type="text" name="app_date" id="app_date" class="form-control rounded-none app_date" placeholder="yyyy-mm-dd" value="{{ old('app_date') }}" />

                    <span class="invalid-feedback app_date"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="app_start">Time</label>
                    <input type="text" name="app_start" id="app_start" class="form-control rounded-none app_start" placeholder="hh:mm"  value="{{ old('app_start') }}"/>

                    <span class="invalid-feedback app_start"></span>
                </div>
            </div>
        </div>

        <p class="text-uppercase mb-2">PATIENT DETAILS</p>

        <div class="form-group flex flex-column mb-1">
            <label for="gender" class="mr-3">Gender:</label>
            <div class="flex">
                <div class="form-check mr-3">
                    <input class="form-check-input gender" type="radio" name="gender" id="male" value="M" {{ getCheckedValue(old('gender'), 'M') }} />
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input gender" type="radio" name="gender" id="female" value="F" {{ getCheckedValue(old('gender'), 'F') }}/>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <span class="invalid-feedback gender"></span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="f_name">First name</label>
                    <input type="text" name="f_name" id="f_name" class="form-control rounded-none f_name" placeholder="Enter first name" value="{{ old('f_name') }}"/>

                    <span class="invalid-feedback f_name"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="l_name">Last name</label>
                    <input type="text" name="l_name" id="l_name" class="form-control rounded-none l_name" placeholder="Enter last name" value="{{ old('l_name') }}" />

                    <span class="invalid-feedback l_name"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input type="text" name="birthday" id="birthday" class="form-control rounded-none birthday" placeholder="yyyy-mm-dd" value="{{ old('birthday') }}" />

                    <span class="invalid-feedback birthday"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone" id="phone" class="form-control rounded-none phone" placeholder="123456" value="{{ old('phone') }}"/>

                    <span class="invalid-feedback name phone"></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>
@endsection

