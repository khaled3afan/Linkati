<template>
	<div class="create-link">
		<a class="btn btn-secondary btn-lg w-100" data-toggle="collapse" href="#add-new-link">
			أضف رابط جديد
		</a>
		<div class="collapse" id="add-new-link">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-600">
							العنوان
							<small class="text-danger">*</small>
						</label>
						<input type="text" v-model="link.name" placeholder="العنوان الظاهر على الزر" name="name"
						       class="form-control" :class="{'is-invalid': errors.name}" required>
						<div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
					</div>
					<div class="form-group">
						<label class="font-weight-600">
							الرابط
							<small class="text-danger">*</small>
						</label>
						<input type="url" name="url" dir="ltr" v-model="link.url" placeholder="لينك الزر"
						       class="form-control" :class="{'is-invalid': errors.url}" required>
						<div class="invalid-feedback" v-if="errors.url">{{errors.url[0]}}</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-outline-primary" data-toggle="collapse" href="#add-new-link">الغاء</button>
					<button class="btn btn-secondary float-left" @click="createLink" :disabled="submiting">
						<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
						اضف اللينك
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState(['profile']),
        data() {
            return {
                errors: {},
                submiting: false,
                link: {},
            }
        },
        methods: {
            createLink: function () {
                this.submiting = true;
                axios.put('/api/' + this.profile.username + '/links/create', {
                    profile_id: this.profile.id,
                    name: this.link.name,
                    url: this.link.url,
                }).then(response => {
                    this.errors = {};
                    this.submiting = false;
                    this.link = {};
                    this.$store.commit('setProfile', response.data.data);
                    this.$toasted.global.error(response.data.message);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.submiting = false;
                });
            },
        }
    }
</script>