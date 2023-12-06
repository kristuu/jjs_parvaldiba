<template>
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-crimson text-white"> <!-- Updated: Use crimson as the accent color -->
        <h4>
          Lietotāji
          <RouterLink to="/users/create" class="btn btn-light float-end">Pievienot lietotāju</RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead class="table-light">
          <tr class="fw-bold">
            <th>PERSONAS KODS</th>
            <th>VĀRDS</th>
            <th>UZVĀRDS</th>
            <th>DZIMŠANAS DATI</th>
            <th>E-PASTS</th>
            <th>TEL. NR.</th>
            <th>ADRESES KODS</th>
            <th>BANKAS KONTA NR.</th>
            <th>DARBĪBAS</th>
          </tr>
          </thead>
          <tbody v-if="this.users.length > 0">
          <tr v-for="(user, index) in this.users" :key="index">
            <td>{{ user.person_code }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.surname }}</td>
            <td>{{ user.birthdate }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>{{ user.googleplaces_address_code }}</td>
            <td>{{ user.iban_code }}</td>
            <td>
              <RouterLink :to="{ path: '/user/'+ user.person_code +'/edit' }" class="btn btn-success">
                Rediģēt
              </RouterLink>
              <button type="button" @click="deleteUser(user.person_code)" class="btn btn-danger float-end">
                Dzēst
              </button>
            </td>
          </tr>
          </tbody>
          <tbody v-else>
          <tr v-if="this.status !== 404">
            <td colspan="9">Ielādē...</td>
          </tr>
          <tr v-else>
            <td colspan="9">Netika atrasts neviens ieraksts</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'userView',
  data() {
    return {
      users: [],
      status: null,
    }
  },
  mounted() {
    this.getUsers()
  },
  methods: {
    getUsers() {
      axios
          .get('http://localhost:8000/api/users')
          .then((response) => {
            this.status = response.status
            this.users = response.data.message
            this.showDetails = new Array(this.users.length).fill(false) // Added: Initialize the array with false values
          })
          .catch((error) => {
            if (error.response && error.response.status === 404) {
              this.status = error.response.status
            }
          })
    },
    deleteUser(person_code) {
      if (confirm('Vai esat pārliecināts, ka vēlaties dzēst šos datus?')) {
        axios
            .delete(`http://localhost:8000/api/user/${person_code}/delete`)
            .then((response) => {
              alert(response.data.message)
              this.getUsers()
            })
            .catch(function (error) {
              if (error.response && error.response.status === 404) {
                alert(error.response.data.message)
              }
            })
      }
    },
  },
}
</script>

<style scoped>
.bg-crimson {
  background-color: darkred; /* Added: Use crimson as the background color */
}
</style>