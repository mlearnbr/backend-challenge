@if (Session::has('error'))
    <div data-messages='[{"level": "error", "message": "{{ Session::get('error') }}"}]'></div>
@endif


@if (Session::has('success'))
    <div data-messages='[{"level": "success", "message": "{{ Session::get('success') }}"}]'></div>
@endif
