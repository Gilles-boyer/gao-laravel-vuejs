import api from './api'
import store from '../store/index'

//collection of request to API for computer
export default {
    create(data) {
        return api.post('computer', data)
    },
    index(date) {
        return api.get('computer/all/' + date + '?page=' + store.state.page)
    },
    delete(id) {
        return api.delete('computer/' + id)
    }
}