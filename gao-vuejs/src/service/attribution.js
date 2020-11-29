import api from './api'

//collection of request to API for computer
export default {
    create(data) {
        return api.post('attribution', data)
    },
    delete(id) {
        return api.delete('attribution/' + id)
    }
}