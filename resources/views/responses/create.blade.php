@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ $survey->title }}</div>
                    <div class="float-right"></div>
                </div>

                <div class="card-body">
                    <form method="POST" action="/responses/{{ $survey->id }}">
                        @csrf

                        @foreach ($survey->questions as $question)
                            <div class="form-group">
                                <label>{{ $question->question_text }}</label>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
