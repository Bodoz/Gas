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
                this.gass.push(data.data.data[0])
            }
        },
        async updateGas(id_gas, gas) {
            let ix = this.gass.findIndex(x => x.id_gas === id_gas)
            const data = await axios.put(`api/gas/${id_gas}`, gas)
            this.gass.splice(ix, 1)
            this.gass.splice(ix, 0 , gas)
        },
        async deleteGas(id_gas){
            const data = await axios.delete(`api/gas/${id_gas}`)
            console.log(data.data)
            if (data.data.result) {
                this.gass = this.gass.filter(x => x.id_gas !== id_gas)
            }
        },
    },
})