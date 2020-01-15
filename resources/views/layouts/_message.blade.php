@if (session()->has('message'))
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-12">
                <div class="notification is-success">
                    <button class="delete"></button>
                    <div class="is-size-6 has-text-weight-bold">
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif (session()->has('error'))
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-12">
                <div class="notification is-danger">
                    <button class="delete"></button>
                    <div class="is-size-6 has-text-weight-bold">
                        {{ session()->get('error') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif (session()->has('warning'))
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-12">
                <div class="notification is-warning">
                    <button class="delete"></button>
                    <div class="is-size-6 has-text-danger has-text-weight-bold">
                        {{ session()->get('warning') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
