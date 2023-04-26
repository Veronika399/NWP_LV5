@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('nastavnik.naslov')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- New Task Form -->
                    <form method="post" action="{{ route('nastavnik.task') }}" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                         <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">{{__('nastavnik.nazivrada')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="naziv_rada" id="task-name" class="form-control">
                            </div>
                        </div>

                        <!-- Task Name EN -->
                        <div class="form-group">
                            <label for="task-name-en" class="col-sm-6 control-label">{{__('nastavnik.nazivradaeng')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="naziv_rada_en" id="task-name-en" class="form-control">
                            </div>
                        </div>

                        <!-- Task -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">{{__('nastavnik.zadrad')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="zadatak_rada" id="task" class="form-control">
                            </div>
                        </div>

                        <!-- Task type -->
                        <div class="form-group">
                            <label for="task-type" class="col-sm-3 control-label">{{__('nastavnik.studij')}}</label>
                            <div class="col-sm-6">
                                <select name="tip_studija">
                                    <option value="preddiplomski" selected="selected">{{__('nastavnik.pred')}}</option>
                                    <option value="diplomski">{{__('nastavnik.dipl')}}</option>
                                    <option value="stručni">{{__('nastavnik.str')}}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Add Save Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">{{__('nastavnik.dodaj')}}</button>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session()->has('message.level'))
                            <div class="alert alert-{{ session('message.level') }}"> 
                            {!! session('message.content') !!}
                            </div>
                        @endif

                    </form>
                </div>
            </div>
            <p>
            <div class="card">
                    <div class="card-header">
                        {{__('nastavnik.')}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped project-table">
                                <thead>
                                    <th>{{__('nastavnik.nazivrada')}}</th>
                                    <th>{{__('nastavnik.nazivradaeng')}}</th>
                                    <th>{{__('nastavnik.odabran')}}</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $task)
                                        <tr>
                                            <td class="table-text"><div>{{ $task->naziv_rada }}</div></td>
                                            <td class="table-text"><div>{{ $task->naziv_rada_en }}</div></td>
                                            <td class="table-text"><div>{{ $task->assignee }}</div></td>
                                            <td><a href="{{ route('nastavnik.task.students' , $task->id) }}">
                                                <button class="btn btn-success">{{__('nastavnik.odaberi')}}</button></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection