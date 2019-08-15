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
                    <form method="POST" action="/response/{{ $survey->id }}" autocomplete="off">
                        @csrf

                        @foreach ($survey->questions as $question)

                            <input type="hidden" value="{{ $question->id }}" name="answers[{{ $question->id }}][question_id]">
                                
                            @switch($question->question_type)
                                @case('input')
                                    <div class="form-group">
                                        <label>{{ $question->question_text }}</label>
                                        <input type="" name="answers[{{ $question->id }}][answer_value]" class="form-control" {{ ($question->is_required) ? 'required' : '' }} >
                                    </div>
                                    @break
                                @case('radio')
                                    <label>{{ $question->question_text }}</label>
                                        @foreach ($question->choices as $choice)
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                name="answers[{{ $question->id }}][answer_value]"
                                                class="form-check-input"
                                                value="{{ $choice->choice_text }}"
                                                {{ ($question->is_required) ? 'required' : '' }}
                                                >
                                            <label class="form-check-label">{{ $choice->choice_text }}</label>
                                        </div>
                                        @endforeach
                                    @break

                                @case('checkbox')
                                    <label>{{ $question->question_text }}</label>
                                        @foreach ($question->choices as $choice)
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="answers[{{ $question->id }}][answer_value]"
                                                class="form-check-input"
                                                value="{{ $choice->choice_text }}"
                                                {{ ($question->is_required) ? 'required' : '' }}
                                            >
                                                <label class="form-check-label">{{ $choice->choice_text }}</label>
                                            </div>
                                        @endforeach
                                    
                                    @break

                                @case('textarea')
                                    <div class="form-group">
                                        <label>{{ $question->question_text }}</label>
                                        <textarea
                                            type="checkbox"
                                            name="answers[{{ $question->id }}][answer_value]"
                                            class="form-control"
                                            rows="4"
                                            {{ ($question->is_required) ? 'required' : '' }}  ></textarea>
                                    </div>
                                    
                                    @break
                                @default
                                    <div class="form-group">
                                        <label>{{ $question->question_text }}</label>
                                        <input
                                            type=""
                                            name="answers[{{ $question->id }}][answer_value]"
                                            class="form-control"
                                            {{ ($question->is_required) ? 'required' : '' }} >
                                    </div>
                            @endswitch

                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Results</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
