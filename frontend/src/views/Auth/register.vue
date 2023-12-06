<template>
  <div>
    <h1>Register</h1>
    <div>
      <label for="name">Vārds</label>
      <input type="text" v-model="user.name">
    </div>
    <div>
      <label for="surname">Uzvārds</label>
      <input type="text" v-model="user.surname">
    </div>
    <div>
      <label for="birthdate">Dzimšanas datums</label>
      <input type="date" v-model="user.birthdate">
    </div>
    <div>
      <label for="person_code">Personas kods</label>
      <input type="text" v-model="user.person_code">
    </div>
    <div>
      <label for="email">Email</label>
      <input type="text" v-model="user.email">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" v-model="user.password">
    </div>
    <div>
      <label for="password_confirmation">Confirm Password</label>
      <input type="password" v-model="user.password_confirmation">
    </div>
    <button @click="register()">Register</button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Register',
  data() {
    return {
      user: {
        person_code: '',
        name: '',
        surname: '',
        email: '',
        password: '',
        birthdate: '',
        password_confirmation: ''
      }
    };
  },
  methods: {
    register() {
      console.log(this.user);
      axios.post('http://127.0.0.1:8000/api/register', this.user)
          .then(({data}) => {
            this.$router.push('/login');
          })
          .catch((error) => {
            console.log(error);
          });
    }
  }
}
</script>