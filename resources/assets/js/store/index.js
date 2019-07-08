export default {
    state: {
        user: {},
        profile: {},
        env: 'local',
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setProfile(state, payload) {
            state.profile = payload;
        },
        setEnv(state, payload) {
            state.env = payload;
        },
    }
}