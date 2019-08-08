<template>
	<div class="card text-center pt-4 pb-2 border-0" :class="'theme--'+profile.theme.key">
		<img :src="profile.avatar_url" class="rounded-circle mx-auto" width="90" height="90" :alt="profile.name">
		<div class="card-body">
			<h4 class="card-title font-weight-600 mb-2">{{ profile.name }}</h4>
			<small class="text-muted d-block" dir="ltr">@{{ profile.username }}</small>
			<p class="card-text mb-1 font-weight-600" v-if="profile.location">
				<i class="fas fa-map-marker-alt"></i>
				{{ profile.location }}
			</p>
			<p class="card-text mb-0" v-if="profile.bio">{{ profile.bio }}</p>
		</div>
		<ul class="list-group list-group-flush p-0">
			<li class="list-group-item bg-transparent border-0" v-for="(link, idx) in profile.links">
				<a :href="link.url" :key="idx" :class="profile.theme.settings.button" class="w-100 text-right btn-lg"
				   rel="nofollow noopener noreferrer">
					<i class="mr-2" :class="link.icon"></i>
					{{ link.name }}
				</a>
			</li>
		</ul>
	</div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState(["profile"]),
    }
</script>