@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $survey->title }}</div>

                <div class="card-body">
                    <form method="POST" action="/surveys/{{ $survey->id }}/questions" autocomplete="off">
                        @csrf

                        @method('PATCH')
    
                        <div class="questions-container">
                            <h3>Questions</h3>
                            @foreach ($survey->questions as $key => $question)
                                <div
                                    class="question"
                                    id="question_{{ $question->id }}"
                                    data-question="{{ $question->id }}">
                                    <input
                                        type="hidden"
                                        name="questions[{{ $question->id }}][ID]"
                                        value="{{ $question->id }}" />

                                    <h4 class="">
                                        <div class="clearfix">
                                            <span class="float-left">Question {{ $question->question_order }}</span>
                                            <span class="float-right">
                                                <a
                                                    href="#"
                                                    data-question="{{ $question->id }}"
                                                    data-survey="{{ $survey->id }}"
                                                    class="btn btn-danger btn-sm delete-question"
                                                >Delete Question</a>
                                            </span>
                                        </div>
                                    </h4>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Question Type</label>
                                        <div class="col-md-4">
                                            <select
                                                name="questions[{{ $question->id }}][question_type]"
                                                class="form-control form-control-sm question_type" data-question="{{ $question->id }}"
                                            >
                                                <option value="input" {{ ($question->question_type === 'input') ? 'selected' : '' }} >Open Text</option>
                                                <option value="radio" {{ ($question->question_type === 'radio') ? 'selected' : '' }} >Select One</option>
                                                <option value="checkbox" {{ ($question->question_type === 'checkbox') ? 'selected' : '' }} >Select Many</option>
                                                <option value="textarea" {{ ($question->question_type === 'textarea') ? 'selected' : '' }} >Multi-line Open Text</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="questions[{{ $question->id }}][is_required]"
                                                        value="1"
                                                        {{ ($question->is_required == 1) ? 'checked' : '' }}
                                                    > Required question
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Question Text</label>
                                        <div class="col-md-10">
                                            <input
                                                type=""
                                                name="questions[{{ $question->id }}][question_text]"
                                                class="form-control form-control-sm" value="{{ $question->question_text }}" />
                                        </div>
                                    </div>
                                                                    
                                </div>
                                
                            @endforeach
                            
                        </div>
                        <a
                            href="#"
                            class="btn btn-default btn-sm add-question" data-survey="{{ $survey->id }}"
                        ><i class="fa fa-plus"></i> Add Question</a>
                        
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            <a href="/surveys">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
