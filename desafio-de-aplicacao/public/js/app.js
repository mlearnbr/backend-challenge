new Vue({
    el: '#app',
    data() {
        return {
            msisdn: '',
            name: '',
            access_level: '',
            password: '',
            users: null,
        }
    },
    mounted() {
        this.getAllUsers();
    },
    methods: {
        getAllUsers: function () {
            axios.get('/api/users')
                .then(response => (this.users = response.data));
        },
        insertUser: function (event) {
            if (event) {
                axios.post('/api/users', {
                    msisdn: this.msisdn,
                    name: this.name,
                    access_level: this.access_level,
                    password: this.password,
                }).then(function (response) {

                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        update: function (id) {
            bootbox.confirm("Você deseja fazer o Upgrade do usuário?", function (result) {
                if (result == true) {
                    axios.put('/api/users/' + id)
                        .then(response => (bootbox.alert(response.data.success)));
                }
            });
        },
        deleteUser: function (id) {
            bootbox.confirm("Você deseja fazer o Downgrade do usuário?", function (result) {
                if (result == true) {
                    axios.delete('/api/users/' + id)
                        .then(response => (bootbox.alert(response.data.success)));
                }
            });
        },
    }
})