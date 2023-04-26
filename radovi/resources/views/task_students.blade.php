@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $task->naziv_rada }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('nastavnik.task.student', $task->id) }}">
                    {{ csrf_field() }}
                    <table class="table table-striped project-table">
                            <thead>
                                <th>{{__('taks_students.imeStudenta')}}</th>
                                <th>{{__('taks_students.emailStudenta')}}l</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($task->students as $student)
                                    <tr>
                                        <td class="table-text"><div>{{ $student->name }}</div></td>
                                        <td class="table-text"><div>{{ $student->email }}</div></td>
                                        <td>
                                            <button type="submit" class="btn btn-success"
                                                name=student value={{ $student->id }}>{{__('taks_students.odaberi')}}</button>
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
</div>
@endsection
