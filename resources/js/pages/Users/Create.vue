<template>
  <v-row align="center" justify="center">
      <v-col class="text-center">
          <v-card rounded class="mx-auto">
              <v-container>
                 <v-form ref="form" v-model="valid">
                  <v-row align="center" justify="center">
                      <v-col class="text-center">
                          <v-text-field v-model="user.name" :rules="rules.name" :counter="200" label="Nome Completo" required />
                      </v-col>
                      <v-col class="text-center">
                          <v-text-field v-model="user.phone" maxlength="11" :rules="rules.phone" max-le  :counter="11" label="Numero Celular" required />
                      </v-col>
                  </v-row>
                  <v-row align="center" justify="center">
                      <v-col class="text-center">
                          <v-text-field v-model="user.email" :rules="rules.email" :counter="200" label="Email" required />
                      </v-col>
                      <v-col class="text-center">
                          <v-text-field v-model="user.password" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :rules="rules.password" label="Senha" required />
                      </v-col>
                  </v-row>
                  <v-row align="center" justify="center">
                      <v-col class="text-center">
                          <v-select v-model="user.accessLevel" item-text="label" item-value="value" :rules="rules.accessLevel" :items="accessLevels" label="Nivel de Acesso" />
                      </v-col>
                  </v-row>
              </v-form>
              </v-container>
              <v-divider />
              <v-card-actions>
                <v-container class="pt-0 pb-0">
                    <v-row justify="end">
                        <v-col cols="4" class="text-right">
                            <v-btn color="success" @click="saveUser" block>Salvar</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
              </v-card-actions>
          </v-card>
      </v-col>
  </v-row>
</template>

<script>
  export default {
    name: 'Create',
    data () {
      return {
        valid: null,
        accessLevels: [{ value: 'free', label: 'Nivel Free' }, { value: 'premium' , label: 'Nivel Premium'}],
        showPassword: false,
        user: {
          name: '',
          phone: '',
          email: '',
          password: '',
          accessLevel: null
        },
        rules: {
          name: [
            v => !!v || 'Nome é obrigatório'
          ],
          phone: [
            v => !!v || 'Numero celular é obrigatório',
            v => v.length === 11 || 'Numero de celular invalido',
            v => !(/\D/.test(v)) || 'Numero de celular invalido',
          ],
          email: [
            v => !!v || 'email é obrigatório',
            v => /.+@.+/.test(v) || 'E-mail deve ser valido'
          ],
          password: [
            v => !!v || 'Senha é obrigatória'
          ]
        }
      }
    },
    methods: {
      getUser() {
        const user = {};
        Object.keys(this.user).forEach(attribute => {
          if (this.user[attribute] !== null && this.user[attribute] !== '') {
            user[attribute] = this.user[attribute];
          }
        })

        return user;
      },
      saveUser () {
        this.$refs.form.validate()
        if (this.valid) {
          window.Swal.fire({title: "Carregando", text: 'Aguarde enquanto processamos.'});
          window.Swal.showLoading();
          window.axios.post('/users', this.getUser()).then(response => {
              if (response.data.success && response.status === 200) {
                  window.Swal.fire({
                      title: 'Sucesso',
                      text: 'Usuario Cadastrado',
                      timer: 4000,
                      icon: 'success',
                      showConfirmButton: false,
                      onClose: () => window.location.reload()
                  });
              }
          }).catch(error => {
              window.Swal.fire({
                  title: 'Erro',
                  text: error.response.data.message,
                  icon: 'error',
                  confirmButtonText: 'Tentar Novamente',
                  cancelButtonText: 'Cancelar',
                  showCancelButton: true,
              }).then(close => {
                  if (close.isConfirmed) {
                      this.saveUser()
                  }
              });
          })
        }
      }
    }
  };
</script>

<style scoped>

</style>
