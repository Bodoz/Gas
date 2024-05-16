import {defineStore} from "pinia";

import axios from "axios"
import iconLogo from "@/components/icons/IconLogo.vue";

export const useUsersStore = defineStore("user",{
    state: () => ({
        show_login: true,
        user: null,
        users: [],
        isAdmin: false
    }),
    actions: {
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
        async fetchUsers() {
            try{
                const data = await axios.get('api/user')
                let user = data.data.data
                this.user = user
                console.log(user)
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
        async deleteUser(id){
            const data = await axios.delete(`api/users/${id}`)
            console.log(data.data)
            if (data.data.result) {
                this.users = this.users.filter(x => x.id !== id)
            }
        },
    },
})