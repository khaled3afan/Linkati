<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-pencil-alt"></i> تعديل البيانات
		</div>
		<div class="card-body">
			<form @submit="updateProfile" class="form-horizontal">
				<div class="form-group row">
					<label class="col-md-3">الصورة الشخصية</label>
					<div class="col-md-9">
						<input class="form-control" :class="{'is-invalid': errors.avatar}" type="file" v-on:change="onFileChange">
						<div class="invalid-feedback" v-if="errors.avatar">{{errors.avatar[0]}}</div>
					</div>
				</div>

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
						<label class="d-block">موقعك</label>
					</div>
					<div class="col-md-9">
						<input class="form-control" :class="{'is-invalid': errors.location}" type="text" v-model="profile.location"
						       placeholder="Istanbul, Turkey">
						<div class="invalid-feedback" v-if="errors.location">{{errors.location[0]}}</div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label class="d-block">نبذة عنك</label>
					</div>
					<div class="col-md-9">
						<textarea class="form-control" :class="{'is-invalid': errors.bio}" v-model="profile.bio" rows="5"
						          placeholder="ما يكتب هنا سوف يظهر في حسابك"></textarea>
						<div class="invalid-feedback" v-if="errors.bio">{{errors.bio[0]}}</div>
					</div>
				</div>

				<hr>

				<draggable tag="ul" :list="list" class="list-group" handle=".handle">
					<li
							class="list-group-item"
							v-for="(element, idx) in list"
							:key="element.id">
						<a class="btn btn-primary btn-lg w-100 text-right" data-toggle="collapse" :href="'#link-'+ element.id">
							<i class="fas fa-sort handle" style="padding: 20px;margin: -8px -16px -8px 0;"></i>
							<!--<i class="fas fa-grip-vertical"></i>-->
							<!--<i class="fas fa-arrows-alt"></i>-->
							<span>{{ element.name }}</span>
						</a>
						<div class="collapse" :id="'link-'+ element.id">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label>الاسم</label>
										<input type="text" name="name" class="form-control" v-model="element.name">
									</div>
									<div class="form-group">
										<label>الرابط</label>
										<input type="url" class="form-control" v-model="element.url">
									</div>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary" @click="removeAt(idx)">حفظ</button>
									<button class="btn btn-danger float-left" @click="removeAt(idx)">حذف</button>
								</div>
							</div>
						</div>
					</li>
				</draggable>

				<pre dir="ltr" class="text-left bg-light p-4">{{list}}</pre>

			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary" type="button" :disabled="submiting" @click="updateProfile">
				<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
				تعديل الحساب
			</button>
		</div>
	</div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        props: [
            'profile'
        ],
        components: {
            draggable,
        },
        data() {
            return {
                errors: {},
                submiting: false,

                list: [
                    {name: "John", text: "", id: 0},
                    {name: "Joao", text: "", id: 1},
                    {name: "Jean", text: "", id: 2}
                ],
                dragging: false
            }
        },
        methods: {
            removeAt(idx) {
                this.list.splice(idx, 1);
            },
            add: function () {
                id++;
                this.list.push({name: "Juan " + id, id, text: ""});
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
                        this.$toasted.global.error('Profile updated!');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
            }
        }
    }
</script>