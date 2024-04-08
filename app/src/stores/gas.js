import {defineStore} from "pinia";
import axios from "axios"

export const useGassStore = defineStore("gas",{
    state: () => ({
        gass: [],
    }),
    actions: {
        async fetchGass() {
            try{
                const data = await axios.get('api/gas')
                let gass = data.data.data
                this.gass = gass
                console.log(gass)
            } catch(error) {
                alert(error)
                console.log(error)
            }
        },
    },
})