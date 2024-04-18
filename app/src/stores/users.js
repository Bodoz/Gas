import {defineStore} from "pinia";

import axios from "axios"

export const useUsersStore = defineStore("user",{
    state: () => ({
        show_login: true,
        user: null,
        users: [],
    }),
    actions: {
        async authorize(credentials) {
            console.log(credentials)
            try{
                const data = await axios.post('api/users/authorize', credentials)
                let user = data.data.data
                console.log(data.data)
                this.user = user
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
            const data = await axios.post(`api/user/`, user)
            if(data.data.result){
                this.users.push(data.data.data[0])
            }
        },
    },
})