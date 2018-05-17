@extends('layouts.master')

@section('title', "| Today's Appointments")


@section('content')
    <div class="card card-default bg-yellow">
        <table class="table table-bordered bg-white mb-0 daily-calendar">
            <p class="p-3 font-bold text-lg">{{ dailyTime() }}</p>
            <thead class="bg-grey-lighter">
                <th>Time</th>
                @foreach ($profiles as $profile)
                    <th>
                        <a href="#" class="uppercase">
                            {{ $profile->name }}
                        </a>
                    </th>
                @endforeach
            </thead>
            <tbody>
                {{-- @php
                    $collection = collect(WorkingHours::all());
                    $profile = \App\Profile::first();
                @endphp --}}

                {{-- @foreach ($profile->workdays()->where('work_day_id', 4)->get() as $day)
                    {{$day->pivot->start}}
                    @if ($day->pivot->start > '17:00')
                        YES
                    @else
                        NO
                    @endif
                @endforeach --}}
                @foreach (workingHours(9,15,24) as $hour)
                    <tr>
                        <td class="bg-grey-lightest">
                            {{ $hour }}
                        </td>
                        @foreach ($profiles as $profile)
                            @forelse ($profile->getAppointments(today(config('app.timezone')), $hour) as $appointment)
                                <td
                                    @foreach ($profile->workdays()->where('work_day_id', 4)->get() as $day)
                                       {{$day->pivot->start}}
                                       @if ($hour < $day->pivot->start || $hour > $day->pivot->end )
                                           class = "bg-grey"
                                       @endif
                                   @endforeach
                                >
                                    {{ fullName($appointment->patient->f_name, $appointment->patient->l_name) }}
                                </td>
                            @empty
                                <td></td>
                            @endforelse
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection