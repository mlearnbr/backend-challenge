@extends('welcome')
@section('content')
<div id="app">
    <h2 style="margin-top: 12px;" class="alert alert-success">{{__('message.list') }}</h2><br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
        {{__('message.btn-add') }}
    </button>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{__('message.table.contact') }}</th>
                <th>{{__('message.table.name') }}</th>
                <th>{{__('message.table.access') }}</th>
                <th colspan="2">{{__('message.table.manage') }}</th>
            </tr>
        </thead>
        <tbody v-for="user in users">
            <td>@{{user.msisdn}}</td>
            <td>@{{user.name}}</td>
            <td>@{{user.access_level}}</td>
            <td><button type="button" class="btn btn-warning" @click="update(user.id);">Upgrade</button></td>
            </td>
            <td><button type="button" class="btn btn-danger" @click="deleteUser(user.id);">Downgrade</button></td>
        </tbody>
    </table>
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="modalAddUser"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalAddUser">{{__('message.modal-form.modal-body') }}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit="insertUser">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{__('message.modal-form.contact') }}</label>
                            <input type="text" v-model="msisdn" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{__('message.modal-form.name') }}</label>
                            <input type="text" v-model="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{__('message.modal-form.access') }}</label>
                            <select class="form-control" v-model="access_level">
                                <option value="free">FREE</option>
                                <option value="premium">PREMIUM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{__('message.modal-form.password') }}</label>
                            <input type="password" v-model="password" class="form-control">
                        </div>
                        <button class="btn btn-primary">{{__('message.modal-form.save') }}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('message.modal-form.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection