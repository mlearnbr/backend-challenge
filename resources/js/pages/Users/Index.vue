<template>
  <v-row align="center" justify="center">
      <v-col class="text-center">
        <v-data-table :headers="columns" :items="users" :items-per-page="10" class="elevation-1">
            <template v-slot:item.accessLevel="{ item }">
                <div>{{ item.accessLevel === 'free' ? 'Free' : 'Premium' }} </div>
            </template>
            <template v-slot:item.action="{ item }">
                <v-btn v-if="item.accessLevel === 'free'" @click="upgradeUser(item.id)" color="success" icon title="Upgrade">
                    <v-icon>mdi-arrow-up-bold</v-icon>
                </v-btn>
                <v-btn v-else color="error" icon @click="downgradeUser(item.id)" title="Downgrade">
                    <v-icon>mdi-arrow-down-bold</v-icon>
                </v-btn>
            </template>
        </v-data-table>
       </v-col>
  </v-row>
</template>

<script>
  export default {
    name: 'Index',
    data () {
      return {
        columns: [
          { text: 'ID', value: 'id', align: 'center'},
          { text: 'Nome', value: 'name', align: 'center'},
          { text: 'Telefone', value: 'phone', align: 'center'},
          { text: 'Email', value: 'email', align: 'center'},
          { text: 'MLearn ID', value: 'externalId', align: 'center'},
          { text: 'Nível de Acesso', value: 'accessLevel', align: 'center'},
          { text: 'Ação', value: 'action', align: 'left'},
        ],
        users: []
      }
    },
    methods: {
      construct () {
        this.setUsers();
      },
      async setUsers () {
        const response = await window.axios.get('/users');
        if (response.data.success) {
          this.users = response.data.data;
        }
      },
      async downgradeUser (userId) {
        this.load();
        const response = await window.axios.put('/users/downgrade/' + userId);
        if (response.data.success) {
            await this.setUsers();
            window.Swal.close();
        }
      },
      async upgradeUser (userId) {
          this.load();
          const response = await window.axios.put('/users/upgrade/' + userId);
          if (response.data.success) {
              await this.setUsers();
              window.Swal.close();
          }
      },
      load () {
        window.Swal.fire({title: "Carregando", text: 'Aguarde enquanto processamos.'});
        window.Swal.showLoading();
      }
    },
    mounted () {
      this.$nextTick(() => this.construct())
    }
  };
</script>

<style scoped>

</style>
