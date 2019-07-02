<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-pencil-alt"></i> تعديل البيانات
		</div>
		<div class="card-body">
			<form class="form-horizontal">
				<div class="form-group row">
					<label class="col-md-3">الاسم الظاهر</label>
					<div class="col-md-9">
						<input class="form-control" :class="{'is-invalid': errors.name}" type="text" v-model="profile.name">
						<div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">اسم المستخدم</label>
					<div class="col-md-9">
						<input class="form-control" :class="{'is-invalid': errors.username}" type="text" v-model="profile.username">
						<div class="invalid-feedback" v-if="errors.username">{{errors.username[0]}}</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label class="d-block">المنصب الوظيفي</label>
						<span class="help-block">سوف يظهر بجانب إسمك.</span>
					</div>
					<div class="col-md-9">
						<input class="form-control" :class="{'is-invalid': errors.username}" type="text" v-model="profile.username">
						<div class="invalid-feedback" v-if="errors.username">{{errors.username[0]}}</div>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<div class="form-group row">
				<div class="col-md-9 offset-md-3">
					<button class="btn btn-primary" type="button" :disabled="submiting" @click="updateAuthUser">
						<i class="fas fa-spinner fa-spin" v-if="submiting"></i> Save
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props: [
            'profile'
        ],
        data() {
            return {
                // profile: {},
                errors: {},
                submiting: false
            }
        },
        mounted() {
            // this.getAuthUser()
        },
        methods: {
            getAuthUser() {
                // axios.get('/api/profile/getAuthUser')
                //     .then(response => {
                //         this.user = response.data
                //     })

                // this.user = window.Linkati.auth;
            },
            updateAuthUser() {
                this.submiting = true;
                axios.put('/api/profile/update', this.profile)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.global.error('Profile updated!');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    })
            }
        }
    }
</script>