@extends('partials.layout')

@section('content')
@include('partials.menu')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.edit', ['id' => $question->id]) }}">{{ $question->description }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Opções
                    </li>
                </ol>
            </nav>
            <h1>LaraQuiz - Opções</h1>
            <a href="{{ route('options.create', ['question_id' => $question->id]) }}" class="btn btn-success">Inserir</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Correta?</th>
                    <th>Ações</th>
                </tr>
                @foreach($options as $option)
                    <tr>
                        <td>{{ $option->id }}</td>
                        <td>{{ $option->description }}</td>
                        <td>{{ ($option->correct) ? 'Sim' : 'Não' }}</td>
                        <td>
                            <form action="{{ route('options.destroy', ['id' => $option->id, 'question_id' => $option->question_id]) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <a href="{{ route('options.edit', ['id' => $option->id, 'question_id' => $option->question_id]) }}" class="btn btn-info">Editar</a>
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection