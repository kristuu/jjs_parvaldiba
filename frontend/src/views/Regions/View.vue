<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>
          Regions
          <RouterLink to="/regions/create" class="btn btn-primary float-end">Pievienot reģionu</RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr class="fw-bold">
              <th>ID</th>
              <th>REĢIONA NOSAUKUMS</th>
              <th>IZVEIDOTS</th>
              <th>DARBĪBAS</th>
            </tr>
          </thead>
          <tbody v-if="this.regions.length > 0">
            <tr v-for="(region, index) in this.regions" :key="index">
              <td>{{ region.id }}</td>
              <td>{{ region.name }}</td>
              <td>{{ region.created_at }}</td>
              <td>
                <RouterLink :to="{ path: '/region/'+ region.id +'/edit' }" class="btn btn-success">
                  Rediģēt
                </RouterLink>
                <button type="button" @click="deleteRegion(region.id)" class="btn btn-danger float-end">
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
  name: 'regions',
  data() {
    return {
      regions: []
    }
  },
  mounted() {
    this.getRegions()

    // console.log('es esmu seit')
  },
  methods: {
    getRegions() {
      axios.get('http://localhost:8000/api/regions').then(response => {
        this.regions = response.data.message
        // console.log(this.regions)
      })
    },
    deleteRegion(regionID) {
      if (confirm('Vai esat pārliecināts, ka vēlaties dzēst šos datus?')) {
        axios.delete(`http://localhost:8000/api/region/${regionID}/delete`)
            .then(response => {
              alert(response.data.message)

              this.getRegions()
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