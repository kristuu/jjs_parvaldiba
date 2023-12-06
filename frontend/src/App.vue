<script>
import { RouterLink, RouterView } from 'vue-router'
import Auth from '@/services/Auth.js';
import axios from 'axios';

export default {
  data() {
    return {
      loggedUser: Auth.user,
    };
  },
  mounted() {
    console.log(Auth.user);
  },
  watch: {
    '$route': function() {
      this.loggedUser = Auth.user;
    }
  },
  methods: {
    logout() {
      axios.post('http://127.0.0.1:8000/api/logout')
          .then(response => {
            console.log(response)
            alert(response.data.message)
            Auth.logout(); // clear user data
            this.$router.push({ path: '/login' })
          })
          .catch(function(error) {
            if (error.response) {
              console.log(error.response.data.message)
            }
          });
    }
  }
};

</script>

<template>
  <header>

    <div class="wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <RouterLink class="navbar-brand" to="#"><img src="src/assets/logo.svg" width="100"/></RouterLink>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" v-if="loggedUser">
              <li class="nav-item">
                <RouterLink class="nav-link active" to="/">Sākums</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/about">Par mums</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/users">Lietotāji</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/instructors">Treneri</RouterLink>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link" @click="logout()">Beigt sesiju</a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" v-else>
              <li class="nav-item">
                <RouterLink class="nav-link active" to="/login">Autorizēties</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/register">Reģistrēties</RouterLink>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />

</template>

<style scoped>

</style>
