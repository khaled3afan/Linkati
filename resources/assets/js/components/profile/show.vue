<template>
	<div class="card text-center pt-4">
		<img :src="profile.avatar_url" class="rounded-circle mx-auto" width="90" :alt="profile.name">
		<div class="card-body">
			<h4 class="card-title font-weight-600 mb-2">{{ profile.name }}</h4>
			<small class="text-muted d-block" dir="ltr">@{{ profile.username }}</small>
			<p class="card-text">{{ profile.location }}</p>
			<p class="card-text">{{ profile.bio }}</p>
		</div>
		<ul class="list-group list-group-flush p-0">
			<li class="list-group-item" v-for="(link, idx) in profile.links">
				<a :href="link.url" class="btn btn-primary w-100 text-right" rel="nofollow noopener noreferrer">
					<i class="ml-2" :class="link.icon"></i>
					{{ link.name }}
				</a>
			</li>
		</ul>

		<div class="card-footer">
			<a class="navbar-brand" href="/">
				<img src="/images/logo.png" width="90px">
			</a>
		</div>
	</div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState(['profile']),
        // props: [
        //     'profile'
        // ],
    }
</script>