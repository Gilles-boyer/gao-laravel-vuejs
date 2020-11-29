import api from './api'

//collection of request to API for computer
export default {
    login(data) {
        return api.post('login', data)
    },
    logout() {
        return api.get('logout')
    },
    index() {
        return api.get('client/all')
    }
}