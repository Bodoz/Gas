import {defineStore} from "pinia";

import axios from "axios"

export const useUsersStore = defineStore("user",{
    state: () => ({
        show_login: true,
        user: null,
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
        }
    },
})