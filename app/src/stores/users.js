import {defineStore} from "pinia";

import axios from "axios"

export const useUsersStore = defineStore("user",{
    state: () => ({
        show_login: true,
        user: null,
        users: [],
        isAdmin: false
    }),
    actions: {
        async fetchUsers() {
            try{
                const data = await axios.get('api/users')
                let users = data.data.data
                this.users = users
                console.log(users)
            } catch(error) {
                alert(error)
                console.log(error)
            }
        },
        async authorize(credentials) {
            console.log(credentials)
            try{
                const data = await axios.post('api/users/authorize', credentials)
                this.user = data.data.data
                if(this.user && this.user['role'] === 1){
                    this.isAdmin = true
                }
                console.log(this.isAdmin)
                this.show_login = false
            } catch(error) {
                alert(error)
                console.log(error)
            }
        },
        async authorized(){
            try{
                const data = await axios.get('api/users/authorized')
                let user = data.data.data
                console.log(data.data)
                this.user = user
            } catch(error) {
                alert(error)
                console.log(error)
            }
        },
        async newUser(user) {
            console.log(user)
            const data = await axios.post('api/user/', user)
            if(data.data.result){
                this.users.push(data.data.data[0])
            }
        },
        async updateUser(id, user) {
            let ix = this.users.findIndex(x => x.id === id)
            const data = await axios.put(`api/user/${id}`, user)
            this.users[ix] = data.data.data
        },
        async deleteUser(id){
            const data = await axios.delete(`api/users/${id}`)
            console.log(data.data)
            if (data.data.result) {
                this.users = this.users.filter(x => x.id !== id)
            }
        },
    },
})