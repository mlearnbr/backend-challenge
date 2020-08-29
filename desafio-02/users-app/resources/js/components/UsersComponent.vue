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
                    <td>
                        <i class="far fa-eye"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users: []
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
    }
}
</script>
<style scoped>

</style>
