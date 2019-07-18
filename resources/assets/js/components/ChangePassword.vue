<template>
	<div class="card">
		<div class="card-header font-weight-600">
			تعديل كلمة المرور
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="font-weight-600">
					كلمة المرور الحالية
					<small class="text-danger">*</small>
				</label>
				<input class="form-control" :class="{'is-invalid': errors.current_password}" type="password"
				       v-model="password.current_password" name="current-password" @keypress.enter="changePassword" required>
				<div class="invalid-feedback" v-if="errors.current_password">{{errors.current_password[0]}}</div>
			</div>
			<div class="form-group">
				<label class="font-weight-600">
					كلمة المرور الجديد
					<small class="text-danger">*</small>
				</label>
				<input class="form-control" :class="{'is-invalid': errors.new_password}" type="password"
				       v-model="password.new_password" name="new-password" @keypress.enter="changePassword" required>
				<div class="invalid-feedback" v-if="errors.new_password">{{errors.new_password[0]}}</div>
			</div>
			<div class="form-group">
				<label class="font-weight-600">
					تاكيد كلمة المرور الجديد
					<small class="text-danger">*</small>
				</label>
				<input class="form-control" :class="{'is-invalid': errors.new_password_confirmation}"
				       v-model="password.new_password_confirmation" name="new-password_confirmation"
				       @keypress.enter="changePassword" type="password"
				       required>
				<div class="invalid-feedback" v-if="errors.new_password_confirmation">{{errors.new_password_confirmation[0]}}
				</div>
			</div>
		</div>
		<div class="card-footer text-left">
			<button class="btn btn-secondary" type="button" :disabled="submiting" @click="changePassword">
				<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
				حفظ البيانات
			</button>
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                password: {
                    current_password: null,
                    new_password: null,
                    new_password_confirmation: null,
                },
                errors: {},
                submiting: false,
            }
        },
        methods: {
            changePassword() {
                this.submiting = true;
                axios.patch('/account/password', this.password)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.password = {};
                        this.$toasted.global.error(response.data.message);
                    })
                    .catch(error => {
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>