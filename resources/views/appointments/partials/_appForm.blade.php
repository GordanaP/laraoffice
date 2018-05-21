<p class="text-uppercase mb-2">APPOINTMENT DETAILS</p>

<div class="form-group">
    <label for="profile">Doctor</label>
    @if (Request::is('appointments/*'))
        <input type="text" name="profile_id" id="profile_id" class="form-control rounded-none" />
    @else
        <select name="profile_id" id="profile_id" class="form-control rounded-none">
            <option>Select a doctor</option>
            @foreach ($profiles as $profile)
                <option value="{{ $profile->id }}">
                    {{ $profile->name }}
                </option>
            @endforeach
        </select>
    @endif
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="text" name="appDate" id="appDate" class="form-control rounded-none" placeholder="yyyy-mm-dd" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="time">Time</label>
            <input type="text" name="appStart" id="appStart" class="form-control rounded-none" placeholder="hh:mm" />
        </div>
    </div>
</div>

<p class="text-uppercase mb-2">PATIENT DETAILS</p>

<div class="form-group flex mb-1">
    <label for="gender" class="mr-3">Gender:</label>
    <div class="flex">
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

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" name="firstName" id="firstName" class="form-control rounded-none" placeholder="Enter first name" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" name="lastName" id="lastName" class="form-control rounded-none" placeholder="Enter last name" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="text" name="birthday" id="birthday" class="form-control rounded-none" placeholder="yyyy-mm-dd" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" class="form-control rounded-none" placeholder="123456" />
        </div>
    </div>
</div>