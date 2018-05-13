@extends('layouts.master')

@section('content')

    <div class="card card-default bg-yellow">
        <table class="table table-bordered bg-white mb-0 daily-calendar">
            <p class="p-3 font-bold text-lg">{{ \Carbon\Carbon::today()->toFormattedDateString() }}</p>
            <thead class="bg-grey-lighter">
                <th>Time</th>
                @foreach (\App\Profile::all() as $profile)
                <th>
                    <a href="#" class="uppercase">
                        {{ $profile->name }}
                    </a>
                </th>
                @endforeach
                {{-- <th><a href="#" class="uppercase">Dr Dusan Prikic</a></th>
                <th><a href="#" class="uppercase">Prim. dr Marina Horvatic</a></th>
                <th><a href="#" class="uppercase">Dr Predrag Paovic</a></th> --}}
            </thead>
            <tbody>
                <tr>
                    <td class="bg-grey-lightest">9.00-9.30</td>
                    <td>Patient1</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">9.30-10.00</td>
                    <td></td>
                    <td>Patient 2</td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">10.00-10.30</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">10.30-11.00</td>
                    <td>Patient 3</td>
                    <td>Patient 4</td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">11.00-11.30</td>
                    <td>Patient 6</td>
                    <td>Patient 7</td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">11.30-12.00</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">12.00-12.30</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">12.30-13.00</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">13.00-13.30</td>
                    <td class="bg-grey-dark"></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">13.30-14.00</td>
                    <td class="bg-grey-dark"></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">14.00-14.30</td>
                    <td class="bg-grey-dark"></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-grey-lightest">14.30-15.00</td>
                    <td class="bg-grey-dark"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection