<template>
	<div class="card">
		<div class="card-header font-weight-600">
			تخصيص الروابط
		</div>
		<div class="card-body">
			<create-link></create-link>

			<draggable tag="ul" :list="profile.links" class="list-group pr-0 mt-4" handle=".handle" @sort="resort">
				<li class="list-group-item"
				    v-for="(link, idx) in profile.links"
				    :key="idx">
					<a class="btn btn-primary btn-lg w-100 text-right" data-toggle="collapse" :href="'#link-'+ link.id">
						<i class="fas fa-sort handle" style="padding: 20px;margin: -8px -16px -8px 0;"></i>
						<i class="mr-2" :class="link.icon"></i>
						<span>{{ link.name }}</span>

						<small class="float-left mt-2 badge badge-secondary font-weight-500"
						       title="عدد النقرات"
						       data-toggle="tooltip"
						       data-placement="right"
						       v-show="profile.user_id === 1 || profile.user_id === 43">
							{{link.clicks}}
						</small>
					</a>
					<div class="collapse" :id="'link-'+ link.id">
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
								<button class="btn btn-outline-danger" @click="deleteLink(link.id, idx)" :disabled="submiting">
									<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
									حذف اللينك
								</button>
								<button class="btn btn-secondary float-left" @click="updateLink(link)" :disabled="submiting">
									<i class="fas fa-spinner fa-spin" v-if="submiting"></i>
									حفظ التعديلات
								</button>
							</div>
						</div>
					</div>
				</li>
			</draggable>

			<pre dir="ltr" class="text-left bg-light p-4 mt-2"
			     v-if="env != 'production'">{{profile.links}}</pre>
		</div>
	</div>
</template>

<script>
    import draggable from 'vuedraggable';
    import {mapState} from 'vuex';

    export default {
        computed: mapState(['profile', 'env']),
        components: {
            draggable,
        },
        data() {
            return {
                errors: {},
                submiting: false,
                dragging: false
            }
        },
        methods: {
            resort(event) {
                axios.put('/dashboard/api/' + this.profile.username + '/links/' + this.profile.links[event.newIndex].id + '/resort', {
                    links: this.profile.links
                }).then(response => {
                    this.$toasted.success(response.data.message);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.submiting = false;
                });
            },
            deleteLink(id, idx) {
                if (confirm('هل انت متاكد؟')) {
                    this.submiting = true;
                    axios.delete('/dashboard/api/' + this.profile.username + '/links/' + id)
                        .then(response => {
                            this.errors = {};
                            this.submiting = false;
                            $('#link-' + id).collapse('hide');
                            this.profile.links.splice(idx, 1);
                            this.$toasted.success(response.data.message);
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors;
                            this.submiting = false;
                        });
                }
            },
            updateLink(link) {
                this.submiting = true;
                axios.put('/dashboard/api/' + this.profile.username + '/links/' + link.id, link)
                    .then(response => {
                        this.errors = {};
                        this.submiting = false;
                        this.$toasted.success(response.data.message);
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