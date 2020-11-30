@extends('partials.layout')

@section('content')
@include('partials.menu')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraQuiz - Usuários</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            @include('partials.errors')

            @if($user->id)
            <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
            {{ method_field('PUT') }}
            @else
            <form action="{{ route('users.store') }}" method="POST">
            @endif

                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do usuário" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-Mail</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail do usuário" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Senha (para manter a senha atual, basta deixar o campo em branco)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>

            </form>
        </div>
    </div>
</div>
@endsection