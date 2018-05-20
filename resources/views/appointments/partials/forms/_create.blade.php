<form action="{{ route('appointments.store') }}" method="POST">

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
</form>