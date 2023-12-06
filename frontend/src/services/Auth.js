import { ref } from 'vue';
import axios from 'axios';

class Auth {
    constructor() {
        this.token = ref(window.localStorage.getItem('token'));
        let userData = window.localStorage.getItem('user');
        this.user = ref(userData ? JSON.parse(userData) : null);

        if (this.token.value) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token.value;
        }
    }

    login(token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        this.token.value = token;
        this.user.value = user;
    }

    check() {
        return !!this.token.value;
    }

    logout() {
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
        this.user.value = null;
        this.token.value = null;
    }
}

export default new Auth();
