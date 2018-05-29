<p class="text-uppercase mb-2">APPOINTMENT DETAILS</p>

<div class="form-group">
    <label for="profile_id">Doctor</label>
    <input type="text" name="profile_id" id="profile_id" class="form-control rounded-none profile_id" />

    <span class="invalid-feedback profile_id"></span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="app_date">Date</label>
            <input type="text" name="app_date" id="app_date" class="form-control rounded-none app_date" placeholder="yyyy-mm-dd" />

            <span class="invalid-feedback app_date"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="app_start">Time: <span id="app-time-label"></span></label>
            <input type="text" name="app_start" id="app_start" class="form-control rounded-none app_start" placeholder="hh:mm" />

            <span class="invalid-feedback app_start"></span>
        </div>
    </div>
</div>

<p class="mb-2">
    <span class="text-uppercase mr-2">Patient details</span>
    <a id="patientLink" href="" target="_blank"><strong>Read More</strong></a>
</p>

<div class="form-group flex mb-2">
    <label for="gender" class="mr-3">Gender:</label>
    <div class="flex" id="gender">
        <div class="form-check mr-3">
            <input class="form-check-input gender" type="radio" name="gender" id="male" value="M" />
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input gender" type="radio" name="gender" id="female" value="F" />
            <label class="form-check-label" for="female">Female</label>
        </div>
    </div>

    <span class="invalid-feedback gender"></span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="f_name">First name</label>
            <input type="text" name="f_name" id="f_name" class="form-control rounded-none f_name" placeholder="Enter first name" />

            <span class="invalid-feedback f_name"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="l_name">Last name</label>
            <input type="text" name="l_name" id="l_name" class="form-control rounded-none l_name" placeholder="Enter last name" />

            <span class="invalid-feedback l_name"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="text" name="birthday" id="birthday" class="form-control rounded-none birthday" placeholder="yyyy-mm-dd" />

            <span class="invalid-feedback birthday"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" class="form-control rounded-none phone" placeholder="123456" />

            <span class="invalid-feedback name phone"></span>
        </div>
    </div>
</div>