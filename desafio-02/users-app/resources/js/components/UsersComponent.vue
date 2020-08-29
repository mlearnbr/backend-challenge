<template>
    <div>
        <h2>Usuários</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">msisdn</th>
                    <th scope="col">Nível acesso</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <th scope="row">{{ user.name }}</th>
                    <td>{{ user.msisdn }}</td>
                    <td>{{ user.access_level }}</td>
                    <td class="table-actions">
                        <i class="far fa-edit edit" @click.prevent="editModal(user)"></i>
                        <i class="fas fa-times delete"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" @click.prevent="newModal">NOVO USUÁRIO</button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addNew"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ !editMode ? 'Novo Usuário' : 'Alterar Usuário' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="!editMode ? createUser() : updateUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Nome"
                                    required
                                    v-model="user.name"
                                >
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="msisdn"
                                    class="form-control"
                                    placeholder="+5586999999999"
                                    required
                                    v-model="user.msisdn"
                                >
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Senha (opcional)"
                                    v-model="user.password"
                                >
                            </div>
                            <div class="form-group">
                                <select
                                    type="text"
                                    name="type"
                                    class="form-control"
                                    v-model="user.access_level"
                                >
                                    <option value="free">free</option>
                                    <option value="premium">premium</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users: [],
            user: {
                name: '',
                msisdn: '',
                password: '',
                access_level: 'free'
            },
            editMode: false
        }
    },
    mounted() {
        axios.get('api/users')
        .then(({data}) => {
            console.log('users', data)
            this.users = data.data
        }).catch((err) => {
            console.log(err)
        });
    },
    methods: {
        newModal() {
            this.editMode = false
            $('#addNew').modal('show')
        },
        createUser() {
            let obj = this.user
            axios.post('api/users', obj)
            .then(({data}) => {
                console.log('usuário criado', data)
                this.users.push(data.data)
                $('#addNew').modal('hide')
                this.user = {
                    name: '',
                    msisdn: '',
                    password: '',
                    access_level: 'free'
                }
            }).catch((err) => {
                console.log(err)
            });
        },
        editModal(user) {
            this.editMode = true
            this.user = user
            $('#addNew').modal('show')
        },
        updateUser() {
            let obj = this.user
            axios.put('api/users/' + obj.id, obj)
            .then(({data}) => {
                console.log('usuário atualizado', data)
                $('#addNew').modal('hide')
                this.user = {
                    name: '',
                    msisdn: '',
                    password: '',
                    access_level: 'free'
                }
            }).catch((err) => {
                console.log(err)
            });
        }
    }
}
</script>
<style scoped>
.table-actions {
    font-size: 18px;
}
.table-actions i {
    padding-right: 6px;
    cursor: pointer;
}
.table-actions i.edit {
    color: #3498db;
}
.table-actions i.delete {
    color: #e74c3c;
}
</style>
