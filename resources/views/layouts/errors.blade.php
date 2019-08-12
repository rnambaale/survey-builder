@if ($errors->{ $bag ?? 'default'}->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->{ $bag ?? 'default' }->all() as $error)
                <li class="text-sm text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
