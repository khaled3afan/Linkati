<template>
	<div class="card themes">
		<div class="card-header font-weight-600">
			القوالب
		</div>
		<div class="card-body pb-0">
			<div class="row">
				<div class="col-md-4" v-for="(theme, idx) in themes" :key="idx"
				     @click="selcetTheme(idx, theme)" :class="{'disabled': theme.selected}">
					<theme :theme="theme"></theme>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState(["themes", "profile"]),
        data() {
            return {
                errors: {},
                submiting: false,
            }
        },
        methods: {
            selcetTheme(idx, theme) {
                this.themes.forEach(function (theme, index) {
                    theme.selected = false;
                });

                this.themes[idx].selected = !this.themes[idx].selected;
                this.profile.theme = theme;
                this.updateTheme(theme);
            },
            updateTheme(theme) {
                this.submiting = true;
                axios.put('/api/' + this.profile.username + '/theme/update', {
                    chosenThem: theme
                }).then(response => {
                    this.errors = {};
                    this.submiting = false;
                    this.$toasted.success(response.data.message);
                    this.$store.commit('setProfile', response.data.data);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.submiting = false;
                });
            }
        }
    }
</script>