<template>
	<div class="card">
		<div class="card-header font-weight-600">
			تخصيص الروابط
		</div>
		<div class="card-body">
			<a class="btn btn-secondary btn-lg w-100" data-toggle="collapse" href="#add-new-link">
				أضف رابط جديد
			</a>

			<div class="collapse" id="add-new-link">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<label>العنوان</label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>الرابط</label>
							<input type="url" class="form-control" required>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">حفظ</button>
						<button class="btn btn-danger float-left">حذف</button>
					</div>
				</div>
			</div>

			<draggable tag="ul" :list="list" class="list-group pr-0 mt-4" handle=".handle">
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

			<pre dir="ltr" class="text-left bg-light p-4 d-none">{{list}}</pre>
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