
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-12">
            @if (count($errors) > 0)
                <div class="notification is-danger" role="alert">
                    <button class="delete"></button>
                    <div class="is-size-7">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{-- <span class="glyphicon glyphicon-remove-sign">&nbsp{{ $error }}</span> --}}
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
