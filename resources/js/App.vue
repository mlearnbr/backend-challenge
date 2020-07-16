<template>
    <v-app id="inspire">
        <nav-bar ref="navBar" />
        <v-app-bar app color="blue" dark>
            <v-app-bar-nav-icon @click.stop="$refs.navBar.toggle()"></v-app-bar-nav-icon>
            <v-toolbar-title>mLearn Teste</v-toolbar-title>
        </v-app-bar>
        <v-main>
            <v-container fluid>
                <h2 class="pl-3" v-if="$route !== undefined && $route.meta.title !== undefined">{{ $route.meta.title }}</h2>
            </v-container>
            <v-container fluid>
                <router-view />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
  import NavBar from './components/Navigation/NavBar';
  export default {
    name: 'App',
    methods: {
    },
    components: {
      NavBar
    }
  };
</script>

<style scoped>

</style>
