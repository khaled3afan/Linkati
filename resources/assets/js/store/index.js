export default {
    state: {
        user: {},
        profile: {},
        env: 'local',
        themes: {},
    },
    getters: {
        selectedTheme: state => {
            return state.themes.filter(theme => theme.selected);
        }
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
        setThemes(state, payload) {
            state.themes = payload;
        },
    },
    actions: {
        getUser({commit, state}, payload) {
            if (window.Linkati.auth) {
                commit('setUser', _.cloneDeep(window.Linkati.auth));
            }
        },
        getProfile({commit, state}, payload) {
            if (window.Linkati.profile) {
                commit('setProfile', _.cloneDeep(window.Linkati.profile));
            }
        },
        getThemes({commit, state}, payload) {
            if (window.Linkati.themes) {
                let themes = _.cloneDeep(window.Linkati.themes);

                themes.forEach(function (theme, index) {
                    theme.selected = theme.key == state.profile.theme.key;
                });

                commit('setThemes', themes);
            }
        }
    }
}