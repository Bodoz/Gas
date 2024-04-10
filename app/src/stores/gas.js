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
        async newGas(gas) {
            const data = await axios.post(`api/gas/`, gas)
            if(data.data.result){
                this.gas.push(data.data.data[0])
            }
        },
        async deleteGas(id){
            const g = this.gass.find(x => x.id_gas === id)
            const data = await axios.delete(`api/gas/${id}`)
            console.log(data.data)
            if (data.data.result) {
                this.gass = this.gass.filter(x => x.id_gas !== id)
            }
        },
    },
})