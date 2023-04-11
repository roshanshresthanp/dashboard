import { createStore } from "vuex";

export default createStore({
    state: {
        counter : 0

    },
    mutations: {
        descreaseCounter (state)
        {
            state.counter--
        }
        ,
        increaseCounter(state)
        {
            state.counter++
        }
    },
    actions: {
        
    },
    modules: {
        
    }
})