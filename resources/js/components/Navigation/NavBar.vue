<template>
    <v-navigation-drawer v-model="navBarExpanded" app>
        <v-list dense>
            <v-list-item link >
                <v-list-item-action>
                    <v-icon>mdi-home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Home</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item link :to="{ name: 'create.user' }">
                <v-list-item-action>
                    <v-icon>mdi-account</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Cadastrar Usuário</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item link :to="{ name: 'index.user' }">
                <v-list-item-action>
                    <v-icon>mdi-account-supervisor</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Usuários</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
  export default {
    name: 'NavBar',
    data () {
      return {
          navBarExpanded: true
      }
    },
    methods: {
      toggle () {
        this.navBarExpanded = !this.navBarExpanded;
      }
    }
  };
</script>

<style scoped>

</style>
