<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\AppointmentRequest;
use App\Patient;
use App\Profile;
use App\Traits\ModelFinder;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use ModelFinder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profile $profile)
    {
        if (request()->ajax())
        {
            return $profile->appointments->load('patient', 'profile');
        }

        $profiles = $this->getProfiles();

        return view('appointments.index')->with([
            'profile' => $profile,
            'profiles' => $profiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profile $profile)
    {
        $profiles = $this->getProfiles();

        return view('appointments.create', compact('profiles', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request, Profile $profile)
    {
        Appointment::createOrUpdate($request);

        if(request()->ajax())
        {
            return message('A new appointment has been created');
        }
        else
        {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile, Appointment $appointment)
    {
        return view('appointments.edit', compact('profile', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile, Appointment $appointment, AppointmentRequest $request)
    {
        Appointment::createOrUpdate($request, $appointment);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
