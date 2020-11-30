@extends('partials.layout')

@section('content')
@include('partials.menu')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.edit', ['id' => $option->question_id]) }}">{{ $option->question->description }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('options.index', ['question_id' => $option->question_id]) }}">Opções</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Formulário
                    </li>
                </ol>
            </nav>
            <h1>LaraQuiz - Opções</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            @include('partials.errors')

            @if($option->id)
            <form action="{{ route('options.update', ['id' => $option->id, 'question_id' => $option->question_id]) }}" method="POST">
            {{ method_field('PUT') }}
            @else
            <form action="{{ route('options.store', ['question_id' => $option->question_id]) }}" method="POST">
            @endif

                {{ csrf_field() }}
                <input type="hidden" name="question_id" id="question_id" value="{{ $option->question_id }}">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descrição da opção">{{ $option->description }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="custom-control custom-switch">
                            @if($option->correct)
                                <input type="checkbox" name="correct" id="correct" class="custom-control-input" value="S" checked>
                            @else
                                <input type="checkbox" name="correct" id="correct" class="custom-control-input" value="S">
                            @endif
                            <label for="correct" class="custom-control-label">Opção correta</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>

            </form>
        </div>
    </div>
</div>
@endsection