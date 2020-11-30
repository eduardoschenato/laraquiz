@if ($errors->any())
    <div class="alert alert-danger">
        <p>Os seguintes erros foram encontrados:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif