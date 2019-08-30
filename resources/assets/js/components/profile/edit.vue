<template>
	<div class="card">
		<div class="card-header font-weight-600">
			تعديل الملف الشخصي
			<small class="float-left font-weight-600 text-muted mt-1">
				عدد الزيارات:
				{{profile.views}}
			</small>
		</div>
		<div class="card-body">
			<div class="media d-sm-block d-md-flex">
				<div class="edit-avatar text-center mr-md-4 mt-md-1 mb-3">
					<label class="position-relative">
						<img :src="profile.avatar_url" :alt="profile.name"
						     class="rounded-circle" width="120px" height="120px">

						<input class="d-none" type="file" :class="{'is-invalid': errors.avatar}"
						       accept="image/jpeg, image/png" v-on:change="onFileChange">
						<strong class="d-flex align-items-center align-content-center text-white h4">
							<i class="fas fa-camera-retro mx-auto"></i>
						</strong>
					</label>
					<div class="invalid-feedback" v-if="errors.avatar">{{errors.avatar[0]}}</div>
					<small class="d-sm-block d-md-none">اضغط لتعديل الصورة</small>
				</div>

				<form class="media-body" @submit="updateProfile">
					<div class="form-group">
						<label class="font-weight-600">
							الاسم الظاهر
							<small class="text-danger">*</small>
						</label>
						<input class="form-control" :class="{'is-invalid': errors.name}" type="text"
						       v-model="profile.name" name="name" @keypress.enter="updateProfile" required>
						<div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
					</div>
					<div class="form-group">
						<label class="font-weight-600">
							اسم المستخدم
							<small class="text-danger">*</small>
						</label>
						<input class="form-control" :class="{'is-invalid': errors.username}" type="text"
						       v-model="profile.username" name="username" @keypress.enter="updateProfile" required>
						<div class="invalid-feedback" v-if="errors.username">{{errors.username[0]}}</div>
					</div>
					<div class="form-group">
						<label class="font-weight-600">موقعك</label>
						<input class="form-control" :class="{'is-invalid': errors.location}" type="text"
						       v-model="profile.location" name="location" @keypress.enter="updateProfile"
						       placeholder="Istanbul, Turkey">
						<div class="invalid-feedback" v-if="errors.location">{{errors.location[0]}}</div>
					</div>
					<div class="form-group mb-0">
						<label class="font-weight-600">نبذة عنك</label>
						<textarea class="form-control" :class="{'is-invalid': errors.bio}" v-model="profile.bio" rows="5"
						          placeholder="ما يكتب هنا سوف يظهر في حسابك"></textarea>
						<div class="invalid-feedback" v-if="errors.bio">{{errors.bio[0]}}</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer text-left">
			<button class="btn btn-secondary" type="button" :disabled="submiting" @click="updateProfile">
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
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.profile.avatar = e.target.result;
                    vm.profile.avatar_url = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            updateProfile() {
                this.submiting = true;
                axios.put('/dashboard/api/' + this.$store.state.profile.username + '/update', this.profile)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.success(response.data.message);
                        this.$store.commit('setProfile', response.data.data);

                        history.pushState({}, null, window.Linkati.domain + '/dashboard/' + response.data.data.username);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>