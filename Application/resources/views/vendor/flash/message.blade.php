@if (session('confirmation'))
    <div data-messages='[{"level": "info", "message": "{{ session('confirmation') }}"}]'></div>
@endif

@if (session('status'))
    <div data-messages='[{"level": "info", "message": "{{ session('status') }}"}]'></div>
@endif

@if (session('flash_notification'))
    <div data-messages="{{ session('flash_notification') }}"></div>
@endif

{{ session()->forget('flash_notification') }}
