<template>
  <div>
    <h1>Login</h1>
    <div>
      <label for="email">Email</label>
      <input type="email" v-model="user.email">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" v-model="user.password">
    </div>
    <button @click="login">Login</button>
  </div>
</template>
<script>
import Auth from '@/services/Auth.js';
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      user: {
        email: '',
        password: '',
      }
    };
  },
  methods: {
    login() {
      axios.post('http://127.0.0.1:8000/api/login', this.user)
          .then(({data}) => {
            Auth.login(data.access_token,data.user); //set local storage
            this.$router.push('/');
          })
          .catch((error) => {
            console.log(error);
          });
    }
  }
}
</script>