@extends('layout.app')
@section('content')

<div class="container" style="margin-top: 1%;">
    <form method="POST" action="{{route('create.user')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
        <div class="form-group">
          <label for="msisdn">Phone</label>
          <input type="msisdn" class="form-control" id="msisdn" aria-describedby="msisdn" name="msisdn">
        </div>
        <div class="form-group">
            <label for="access_level">Access Level</label>
            <select name="access_level" id="access_level" class="form-control">
                <option value="0">Access Level...</option>
                <option value="free">Free</option>
                <option value="premium">Premium</option>
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
