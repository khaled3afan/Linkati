<template>
	<div class="card">
		<div class="card-header font-weight-600">
			تعديل بيانات الحساب
		</div>
		<div class="card-body">
			<div class="media">
				<div class="edit-avatar text-center ml-4 mt-1">
					<label class="position-relative">
						<img :src="profile.avatar_url" width="130px"
						     class="rounded-circle" :alt="profile.name">
						<input class="d-none" type="file" :class="{'is-invalid': errors.avatar}"
						       accept="image/jpeg, image/png"
						       v-on:change="onFileChange">
						<strong class="d-flex align-items-center align-content-center text-white h4">
							<i class="fas fa-camera-retro mx-auto"></i>
						</strong>
					</label>
					<div class="invalid-feedback" v-if="errors.avatar">{{errors.avatar[0]}}</div>
				</div>

				<form class="media-body" @submit="updateProfile">
					<div class="form-group">
						<label class="font-weight-600">الاسم الظاهر</label>
						<input class="form-control" :class="{'is-invalid': errors.name}" type="text" v-model="profile.name">
						<div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
					</div>
					<div class="form-group">
						<label class="font-weight-600">اسم المستخدم</label>
						<input class="form-control" :class="{'is-invalid': errors.username}" type="text"
						       v-model="profile.username">
						<div class="invalid-feedback" v-if="errors.username">{{errors.username[0]}}</div>
					</div>
					<div class="form-group">
						<label class="font-weight-600">موقعك</label>
						<input class="form-control" :class="{'is-invalid': errors.location}" type="text"
						       v-model="profile.location" placeholder="Istanbul, Turkey">
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
    import {mapState} from 'vuex';

    export default {
        props: [
            'profile_id'
        ],
        computed: mapState(['profile']),
        data() {
            return {
                // profile: {},
                errors: {},
                submiting: false,
            }
        },
        mounted() {
            // if (window.Linkati.profile) {
            //     this.$store.commit('setProfile', window.Linkati.profile);
            // }
            // console.log(this.profile);
            this.getProfile();
            // console.log(this.profile);
        },
        methods: {
            getProfile() {
                // this.profile = window.Linkati.profile;
                axios.get('/api/profile/edit', {
                    params: {
                        id: this.profile_id
                    }
                }).then(response => {
                    this.$store.commit('setProfile', response.data.data);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
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
                };
                reader.readAsDataURL(file);
            },
            updateProfile() {
                this.submiting = true;
                axios.put('/api/profile/update', this.profile)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.global.error('تم حفظ البيانات!');
                        this.$store.commit('setProfile', response.data.data);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>