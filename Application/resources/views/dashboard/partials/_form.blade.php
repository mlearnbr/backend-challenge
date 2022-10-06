<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            @inputtext(['name' => 'name', 'entity' => $user]) @endinputtext
        </div>
        <div class="col-md-6">
            @inputtext([
                'name' => 'msisdn',
                'entity' => $user,
                'class' => 'inputmask msisdn'
            ]) @endinputtext
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @select([
                'name' => 'access_level',
                'data' => ['pro' => 'pro', 'premium' => 'premium'],
                'entity' => $user
            ]) @endselect
        </div>
        <div class="col-md-6">
            @inputpassword([
                'name' => 'password',
                'required' => !$user->id
            ]) @endinputpassword
        </div>
    </div>
</div>
