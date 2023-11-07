<template>

  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Pievienot lietotāju</h4>
      </div>
      <div class="card-body">

        <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
          <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
            {{ error[0] }}
          </li>
        </ul>

        <div class="mb-3">
          <label for="">Vārds</label>
          <input type="text" v-model="model.user.name" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="">Uzvārds</label>
          <input type="text" v-model="model.user.surname" class="form-control" />
        </div>
        <div class="mb-3">
          <button type="button" @click="saveUser" class="btn btn-primary">Saglabāt</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from 'axios'

export default {
  name: 'userCreate',
  data() {
    return {
      errorList: '',
      model: {
        user: {
          name: '',
          surname: '',
          birthdate: '',
          email: '',
          password: '',
          phone: '',
          iban: ''
        }
      }
    }
  },
  methods: {
    saveRegion() {

      let mythis = this;

      axios.post('http://localhost:8000/api/users', this.model.user)
          .then(response => {
            console.log(response)
            alert(response.data.message)

            this.model.region = {
              name: ''
            }
            this.errorList = ''
          })
          .catch(function(error) {
            if (error.response) {

              if (error.response.status === 422) {
                mythis.errorList = error.response.data.message
                console.log(mythis.errorList)
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