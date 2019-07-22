<template>
	<div class="card">
		<div class="card-header font-weight-600">
			القوالب
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4" v-for="(theme, idx) in themes"
				     :key="idx"
				     @click="selcetTheme(idx)">
					<theme :theme="theme"></theme>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState(['themes']),
        data() {
            return {
                profile: {},
                errors: {},
                submiting: false,
            }
        },
        mounted() {
            this.$nextTick(function () {
                // Get Profile
                this.profile = _.cloneDeep(this.$store.state.profile);
            });
        },
        methods: {
            selcetTheme(idx) {
                this.themes.forEach(function (theme, index) {
                    theme.selected = false;
                });

                this.themes[idx].selected = !this.themes[idx].selected;
            },
            updateTheme() {
                this.submiting = true;
                axios.put('/api/' + this.$store.state.profile.username + '/themes/update', this.profile)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.global.error(response.data.message);
                        this.$store.commit('setProfile', response.data.data);

                        history.pushState({}, null, window.Linkati.domain + '/' + response.data.data.username);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>