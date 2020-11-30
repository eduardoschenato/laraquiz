@extends('partials.layout')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraQuiz</h1>
            <p class="lead">Faça aqui simulados para o ENEM e vestibular</p>
        </div>
    </div>
    <form class="row mt-3" action="{{ route('result') }}" method="POST">
        {{ csrf_field() }}
        @foreach($questions as $i => $question)
            <div class="col-12">
                <p>{{ ($i + 1) }} . {{ $question->description }}</p>
                @if($question->url_image)
                    <img style="max-width: 500px;" src="{{ asset('storage/questions/' . $question->url_image) }}" alt="{{ $question->description }}" class="img-thumbnail mb-2">
                @endif
                @foreach($question->options()->orderByRaw('RAND()')->get() as $option)
                    <div class="form-check">
                        <input type="radio" name="answers[{{ $question->id }}]" id="opcao{{ $option->id }}" value="{{ $option->id }}" class="form-check-input">
                        <label for="opcao{{ $option->id }}" class="form-check-label">
                            {{ $option->description }}
                        </label>
                    </div>
                @endforeach
                <hr>
            </div>
        @endforeach
        <div class="col-12 mb-5">
            <button type="submit" class="btn btn-lg btn-block btn-success">Enviar respostas</button>
        </div>
    </form>
</div>
@endsection
