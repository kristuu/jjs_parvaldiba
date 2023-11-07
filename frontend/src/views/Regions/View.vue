<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>
          Lietotāji
          <RouterLink to="/regions/create" class="btn btn-primary float-end">Pievienot lietotāju</RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr class="fw-bold">
              <th>ID</th>
              <th>VĀRDS</th>
              <th>UZVĀRDS</th>
              <th>DZIMŠANAS DATI</th>
              <th>E-PASTS</th>
              <th>PAROLE</th>
              <th>TEL. NR.</th>
              <th>BANKAS KONTA NR.</th>
            </tr>
          </thead>
          <tbody v-if="this.users.length > 0">
            <tr v-for="(user, index) in this.users" :key="index">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.created_at }}</td>
              <td>
                <RouterLink :to="{ path: '/user/'+ user.id +'/edit' }" class="btn btn-success">
                  Rediģēt
                </RouterLink>
                <button type="button" @click="deleteUser(user.id)" class="btn btn-danger float-end">
                  Dzēst
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
          <tr>
            <td colspan="4">Ielādē...</td>
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
      users: []
    }
  },
  mounted() {
    this.getUsers()

    // console.log('es esmu seit')
  },
  methods: {
    getUsers() {
      axios.get('http://localhost:8000/api/users').then(response => {
        this.users = response.data.message
        // console.log(this.users)
      })
    },
    deleteUser(userID) {
      if (confirm('Vai esat pārliecināts, ka vēlaties dzēst šos datus?')) {
        axios.delete(`http://localhost:8000/api/region/${userID}/delete`)
            .then(response => {
              alert(response.data.message)

              this.getUsers()
            })
            .catch(function(error) {
              if (error.response) {

                if (error.response.status === 404) {

                  alert(error.response.data.message)
                }
              }
            })
      }
    }
  }
}
</script>