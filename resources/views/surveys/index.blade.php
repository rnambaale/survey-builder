@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Surveys</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Survey Name</th>
                                <th>Edit</th>
                                <th>Take Survey</th>
                                <th>View Results</th>
                                <th>View Charts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveys as $survey)
                            <tr>
                                <td>{{ $survey->title }}</td>
                                <td><a href="/surveys/{{ $survey->id }}/edit">Edit Survey</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
