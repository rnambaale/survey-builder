@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">Surveys</div>
                    <div class="float-right"><a href="/surveys/create" data-toggle="modal" data-target="#addModal">Add Survey</a></div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Survey Name</th>
                                <th>Edit</th>
                                <th>Take Survey</th>
                                <th>View Results</th>
                                <th>Questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveys as $survey)
                            <tr>
                                <td>{{ $survey->title }}</td>
                                <td><a href="/surveys/{{ $survey->id }}/edit" data-toggle="modal" data-target="#addModal">Edit Survey</a></td>
                                <td><a href="/respond/{{ $survey->id }}" target="_blank">Take Survey</a></td>
                                <td><a href="/surveys/{{ $survey->id }}/responses">View Results</a></td>
                                <td><a href="/surveys/{{$survey->id}}/questions">Manage</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade remote-modal" id="addModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <span class="loader">Loading</span>
            </div>
        </div>
    </div>
</div>
@endsection
