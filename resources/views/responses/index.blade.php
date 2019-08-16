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
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($survey->questions as $question)
                                    <th>{{ $question->question_text }}</th>    
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($survey->responses as $response)
                            <tr>
                                @foreach ($survey->questions as $question)
                                    <td>
                                        {{-- search the $response->answers collection for one that has a question_id of $question->id --}}
                                        @if ($response->answers->where('question_id', $question->id)->first())
                                            {{ $response->answers->where('question_id', $question->id)->first()->answer_value }}    
                                        @endif
                                    </td>
                                @endforeach
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
