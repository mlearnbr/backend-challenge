<div id="divNotifications">

    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))

            <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-{{$key}} alert-dismissible fade show">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    {{ Session::get($key) }}
                </div>
                <div class="m-alert__close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    @endforeach

</div>