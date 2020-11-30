@extends('partials.layout')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraQuiz</h1>
            <p class="lead">Faça aqui simulados para o ENEM e vestibular</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <form action="{{ route('quiz') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Categoria</span>
                            </div>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Número de questões</span>
                            </div>
                            <input type="number" name="questions" id="questions" class="form-control" min="1" max="10" value="1">
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <button type="submit" class="btn btn-block btn-success">Gerar simulado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
