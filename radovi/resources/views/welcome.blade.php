@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card card-default">
            <div class="card-header">{{__('welcome.dobrodoslica')}}</div>

            @guest
                <div class="card-body">
                    {{__('welcome.obavijestOprijav')}}
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
