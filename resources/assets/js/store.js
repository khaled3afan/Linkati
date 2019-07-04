export default {
    state: {
        profile: {}
    },
    actions: {
        LOAD_USER_PROFILE: function ({commit}) {
            axios.get('/api/profile/edit').then((response) => {
                commit('SET_USER_PROFILE', {profile: response.data})
            }, (err) => {
                console.log(err);
            })
        },
        UPDATE_USER_PROFILE: function (store, {commit}) {
            axios.put('/api/profile/update', {profile: store.state.profile}).then((response) => {
                commit('SET_USER_PROFILE', {profile: response.data})
            }, (err) => {
                console.log(err)
            })
        }
    },
    mutations: {
        setProfile(state, payload) {
            state.profile = payload;
        },
    }
}