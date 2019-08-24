<template>
	<div class="card">
		<div class="card-header font-weight-600">
			انشاء ملف شخصي
		</div>
		<div class="card-body">
			<div class="media">
				<div class="edit-avatar text-center mr-4 mt-1">
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
				</div>

				<form class="media-body" @submit="createProfile">
					<div class="form-group">
						<label class="font-weight-600">
							الاسم الظاهر
							<small class="text-danger">*</small>
						</label>
						<input class="form-control" :class="{'is-invalid': errors.name}" type="text"
						       v-model="profile.name" name="name" @keypress.enter="createProfile" required>
						<div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
					</div>

					<div class="form-group">
						<label class="font-weight-600">
							اسم المستخدم
							<small class="text-danger">*</small>
						</label>
						<input class="form-control" :class="{'is-invalid': errors.username}" type="text"
						       placeholder="سوف يستخدم في رابط حسابك ويجب ان يكون فريد"
						       v-model="profile.username" name="username" @keypress.enter="createProfile" required>
						<div class="invalid-feedback" v-if="errors.username">{{errors.username[0]}}</div>
					</div>

					<div class="form-group">
						<label class="font-weight-600">موقعك</label>
						<input class="form-control" :class="{'is-invalid': errors.location}" type="text"
						       v-model="profile.location" name="location" @keypress.enter="createProfile"
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
		<div class="card-footer">
			<a href="/" class="btn btn-link text-danger">الغاء</a>
			<button class="btn btn-secondary float-left" type="button" :disabled="submiting" @click="createProfile">
				<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
				حساب جديد
			</button>
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                profile: {
                    avatar_url: '/images/avatar.png',
                },
                errors: {},
                submiting: false,
            }
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
            createProfile() {
                this.submiting = true;
                axios.post('/dashboard/api/profiles/create', this.profile)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.success(response.data.message);

                        window.location = window.Linkati.domain + '/' + response.data.data.username;
                        window.location.href = window.Linkati.domain + '/' + response.data.data.username;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>