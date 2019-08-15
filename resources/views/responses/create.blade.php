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
                    <form method="POST" action="/response/{{ $survey->id }}">
                        @csrf

                        @foreach ($survey->questions as $question)

                            <input type="hidden" value="{{ $question->id }}" name="answers[{{ $question->id }}][question_id]"/>

                            <div class="form-group">
                                <label>{{ $question->question_text }}</label>
                                @switch($question->question_type)
                                    @case('input')
                                        <input type="" name="answers[{{ $question->id }}][answer_value]" class="form-control" {{ ($question->is_required) ? 'required' : }} >
                                        @break
                                    @case('radio')
                                        @foreach ($question->choices as $choice)
                                            <input type="radio" name="answers[{{ $question->id }}][answer_value]" class="form-control" {{ ($question->is_required) ? 'required' : }} > {{ $choice->choice_text }}
                                        @endforeach

                                    @case('checkbox')
                                        @foreach ($question->choices as $choice)
                                            <input type="checkbox" name="answers[{{ $question->id }}][answer_value]" class="form-control" {{ ($question->is_required) ? 'required' : }} > {{ $choice->choice_text }}
                                        @endforeach
                                        
                                        @break

                                    @case('textarea')
                                        <textarea type="checkbox" name="answers[{{ $question->id }}][answer_value]" class="form-control" {{ ($question->is_required) ? 'required' : }} rows="4" ></textarea>
                                        
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
