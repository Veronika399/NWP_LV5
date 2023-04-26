@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('home.nologin') }}
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role=='student')
        <div class="row justify-content-center" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="font-weight: bold;">
                        {{ __('home.objavljeno') }}
                    </div>
                    <div class="card-body">
                        @if(session()->has('message.level'))
                            <div class="alert alert-{{ session('message.level') }}"> 
                            {!! session('message.content') !!}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('student.task') }}">
                            {{ csrf_field() }}
                        <table class="table table-striped project-table">
                                <thead>
                                    <th>{{ __('home.nazivrada') }}</th>
                                    <th>{{ __('home.nazivradaeng') }}</th>
                                    <th>{{ __('home.nastavnik') }}</th>
                                    <th>{{ __('home.studij') }}</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $task)
                                    
                                        <tr>
                                            <td class="table-text"><div>{{ $task->naziv_rada }}</div></td>
                                            <td class="table-text"><div>{{ $task->naziv_rada_en }}</div></td>
                                            <td class="table-text"><div>{{ $task->nastavnik }}</div></td>
                                            <td class="table-text"><div>{{ $task->tip_studija }}</div></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary" name="attach" value="{{$task->id}}">{{ __('home.prijava') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </form>
                    </div>
                </div>

                   <div class="card" style="margin-top: 15px">
                        <div class="card-header" style="font-weight: bold;">
                            {{ __('home.studij') }}
                        </div>
                        <div class="card-body">
                            @if(session()->has('message.level'))
                            <div class="alert alert-{{ session('message.level') }}"> 
                            {!! session('message.content') !!}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('student.task') }}">
                                {{ csrf_field() }}
                            <table class="table table-striped project-table">
                                    <thead>
                                        <th>{{ __('home.nazivrada') }}</th>
                                        <th>{{ __('home.nazivradaeng') }}</th>
                                        <th>{{ __('home.nastavnik') }}</th>
                                        <th>{{ __('home.studij') }}</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                            @foreach ($data as $task)
                                                <tr>
                                                    <td class="table-text"><div>{{ $task->naziv_rada }}</div></td>
                                                    <td class="table-text"><div>{{ $task->naziv_rada_en }}</div></td>
                                                    <td class="table-text"><div>{{ $task->nastavnik }}</div></td>
                                                    <td class="table-text"><div>{{ $task->tip_studija }}</div></td>
                                                    <td>
                                                        @if ($task->disabled)
                                                            <button type="submit" class="btn btn-danger" name="detach" value="{{$task->id}}">{{ __('home.ukloni') }}</button>
                                                        @else
                                                            <p>{{ __('home.nijeizabran') }}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                            </table>
                        </form>
                        </div>
                    </div>
               


            </div>
        </div>
    @endif
</div>
@endsection
