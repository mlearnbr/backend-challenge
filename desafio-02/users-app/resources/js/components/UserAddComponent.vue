<template>
    <div>
        <h2>Novo Usuário</h2>
        <form action="">

        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                name: '',
                msisdn: '',
                password: '',
                access_level: 'free'
            }
        }
    },
    methods: {
        addUser() {
            console.log('usuario', this.user)
        }
    }
}
</script>
<style scoped>

</style>
