<template>

  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Rediģēt lietotāju</h4>
      </div>
      <div class="card-body">

        <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
          <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
            {{ error[0] }}
          </li>
        </ul>

        <div class="row">
          <div class="mb-3 col-4">
            <label for="">Vārds</label>
            <input type="text" v-model="model.user.name" class="form-control has-validation" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Uzvārds</label>
            <input type="text" v-model="model.user.surname" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Personas kods</label>
            <input type="text" v-model="model.user.person_code" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Dzimšanas datums</label>
            <input type="date" v-model="model.user.birthdate" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">E-pasta adrese</label>
            <input type="email" v-model="model.user.email" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Telefona numurs</label>
            <input type="email" v-model="model.user.phone" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Bankas konta numurs</label>
            <input type="email" v-model="model.user.iban_code" class="form-control" />
          </div>
          <div class="mb-3 col-4">
            <label for="">Adreses kods</label>
            <input type="email" v-model="model.user.googleplaces_address_code" class="form-control" />
          </div>
        </div>
        <div class="mb-3">
          <button type="button" @click="updateUser" class="btn btn-primary">Saglabāt</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from 'axios'

export default {
  name: 'userEdit',
  data() {
    return {
      errorList: '',
      model: {
        user: {
          person_code: '',
          name: '',
          surname: '',
          birthdate: '',
          email: '',
          phone: '',
          googleplaces_address_code: '',
          iban_code: ''
        }
      }
    }
  },
  mounted() {
    // console.log(this.$route.params.id)
    this.person_code = this.$route.params.id
    this.getUserData(this.$route.params.id)
  },
  methods: {
    getUserData(userPersonCode) {
      axios.get(`http://localhost:8000/api/user/${userPersonCode}/edit`)
          .then(response => {
            this.model.user = response.data.message
          })
          .catch(function(error) {
            if (error.response) {

              if (error.response.status === 404) {
                alert(error.response.data.message)
              }
            }
          })
    },

    updateUser() {

      let mythis = this;

      axios.put(`http://localhost:8000/api/user/${this.person_code}/edit`, this.model.user)
          .then(response => {
            console.log(response)
            alert(response.data.message)

            this.errorList = ''
          })
          .catch(function(error) {
            if (error.response) {

              if (error.response.status === 422) {
                mythis.errorList = error.response.data.message
              }
              if (error.response.status === 404) {
                alert(error.response.data.message)
              }

              // console.log(error.response.data);
              // console.log(error.response.status);
              // console.log(error.response.headers);
            } else if (error.request) {
              console.log(error.request);
            } else {
              console.log('Error', error.message);
            }
          })
    }
  },
}
</script>