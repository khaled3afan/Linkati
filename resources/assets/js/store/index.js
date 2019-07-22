export default {
    state: {
        user: {},
        profile: {},
        env: 'local',
        themes: [
            {
                'id': 1,
                'is_pro': false,
                'selected': true,
                'name': 'كلاسكي',
                'key': 'classic',
                'thumbnail': '/images/themes/Classic.png'
            },
            {
                'id': 2,
                'is_pro': false,
                'selected': false,
                'name': 'ازرق',
                'key': 'blue',
                'thumbnail': '/images/themes/Blue.png'
            },
            {
                'id': 3,
                'is_pro': false,
                'selected': false,
                'name': 'دارك',
                'key': 'Dark',
                'thumbnail': '/images/themes/Dark.png'
            },
        ],
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