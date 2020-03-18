<template>
    <v-app id="keep">
        <v-app-bar app clipped-left color="amber">
            <span class="title ml-3 mr-5"
                >Challenge 02 - Desafio de Aplicação</span
            >
        </v-app-bar>

        <v-content>
            <v-card class="mx-auto">
                <v-card-title>
                    <v-icon large left>
                        mdi-account-group
                    </v-icon>
                    <span class="title font-weight-light"
                        >Usuários Cadastrados</span
                    >
                </v-card-title>
                <v-card-text class="subtitle py-0">
                    Lista de todos os usuários do sistema
                </v-card-text>
                <v-card-actions class="py-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-data-table
                                    :headers="headers"
                                    :items="users"
                                    class="elevation-1"
                                >
                                    <template v-slot:top>
                                        <v-toolbar flat color="white">
                                            <v-spacer></v-spacer>
                                            <v-dialog v-model="dialog">
                                                <template
                                                    v-slot:activator="{ on }"
                                                >
                                                    <v-btn
                                                        color="primary"
                                                        dark
                                                        class="mb-2"
                                                        v-on="on"
                                                    >
                                                        <v-icon left
                                                            >mdi-account-arrow-right</v-icon
                                                        >
                                                        Novo Usuário</v-btn
                                                    >
                                                </template>
                                                <v-card class="mx-auto">
                                                    <v-card-title>
                                                        <v-icon large left>
                                                            mdi-account-arrow-right
                                                        </v-icon>
                                                        <span
                                                            class="title font-weight-light"
                                                            >Criar novo
                                                            Usuário</span
                                                        >
                                                    </v-card-title>
                                                    <v-card-text
                                                        class="subtitle py-0"
                                                    >
                                                        Inserir um novo usuário
                                                        no sistema
                                                    </v-card-text>
                                                    <v-card-actions
                                                        class="py-0"
                                                    >
                                                        <v-container
                                                            class="py-0"
                                                        >
                                                            <v-row>
                                                                <v-col
                                                                    cols="4"
                                                                    xs="12"
                                                                    class="py-0"
                                                                >
                                                                    <v-text-field
                                                                        v-model="
                                                                            newUser.name
                                                                        "
                                                                        label="Nome"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col
                                                                    cols="4"
                                                                    xs="12"
                                                                    class="py-0"
                                                                >
                                                                    <v-text-field
                                                                        v-model="
                                                                            newUser.cellphone
                                                                        "
                                                                        v-mask="
                                                                            '+55 (##) #####-####'
                                                                        "
                                                                        label="Telefone"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col
                                                                    cols="4"
                                                                    xs="12"
                                                                    class="py-0"
                                                                >
                                                                    <v-text-field
                                                                        v-model="
                                                                            newUser.password
                                                                        "
                                                                        label="Senha"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                            </v-row>
                                                            <v-row>
                                                                <v-col
                                                                    cols="10"
                                                                    class="pt-0"
                                                                ></v-col>
                                                                <v-col
                                                                    cols="2"
                                                                    class="pt-0"
                                                                >
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn
                                                                        color="success"
                                                                        v-on:click="
                                                                            createUser()
                                                                        "
                                                                    >
                                                                        <v-icon
                                                                            dark
                                                                            right
                                                                            >mdi-content-save</v-icon
                                                                        >
                                                                        &nbsp;&nbsp;Criar
                                                                    </v-btn>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </v-toolbar>
                                    </template>
                                    <template v-slot:item.cellphone="{ item }">
                                        {{ formatCellPhone(item.cellphone) }}
                                    </template>
                                    <template v-slot:item.actions="{ item }">
                                        <v-icon
                                            v-if="item.level == 'free'"
                                            color="success"
                                            @click="editUser(item.id, 1)"
                                        >
                                            mdi-arrow-up-circle
                                        </v-icon>
                                        <v-icon
                                            v-if="item.level == 'premium'"
                                            color="deep-orange"
                                            @click="editUser(item.id, 2)"
                                        >
                                            mdi-arrow-down-circle
                                        </v-icon>
                                    </template>
                                </v-data-table>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-actions>
            </v-card>
        </v-content>
    </v-app>
</template>

<script>
import { mask } from "vue-the-mask";
export default {
    directives: { mask },
    data: () => ({
        dialog: false,
        newUser: {
            name: "",
            cellphone: "",
            password: ""
        },
        headers: [
            { text: "Nome", sortable: true, value: "name" },
            { text: "Celular", value: "cellphone" },
            { text: "Level", value: "level", sortable: true },
            { text: "Opções", value: "actions" }
        ],
        users: []
    }),
    computed: {},
    methods: {
        createUser: function() {
            let self = this;
            this.newUser.cellphone = this.newUser.cellphone.replace(
                /(\s)|(-)|(\()|(\))/g,
                ""
            );
            $.post("/user", this.newUser, function(data) {
                if (data.status === true) {
                    self.newUser.name = "";
                    self.newUser.cellphone = "";
                    self.newUser.password = "";
                    self.dialog = false;
                    self.loadAllUsers();
                }
            });
        },
        loadAllUsers: function() {
            let self = this;
            $.get("/user", function(data) {
                self.users = data;
            });
        },
        editUser: function(id, type) {
            let self = this;
            let route = type == 1 ? "/user/upgrade" : "/user/downgrade";
            $.ajax({
                url: route,
                type: "PUT",
                data: { id: id },
                success: function(result) {
                    self.loadAllUsers();
                }
            });
        },
        formatCellPhone: function(phone) {
            let regex = phone.match(/^(\+\d{2})(\d{2})(\d{1})(\d{4})(\d{4})$/);

            if (regex) {
                return (
                    regex[1] +
                    " (" +
                    regex[2] +
                    ") " +
                    regex[3] +
                    " " +
                    regex[4] +
                    "-" +
                    regex[5]
                );
            }

            return null;
        }
    },
    mounted: function() {
        this.loadAllUsers();
    }
};
</script>

<style></style>
