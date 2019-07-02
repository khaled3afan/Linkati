<template>
	<div class="card text-center pt-4">
		<img :src="profile.avatar_url" class="rounded-circle mx-auto" width="90" :alt="profile.name">
		<div class="card-body">
			<h5 class="card-title">
				{{ profile.name }}
				<small class="d-block">@{{profile.username}}</small>
			</h5>
			<p class="card-text">{{ profile.location }}</p>
			<p class="card-text">{{ profile.bio }}</p>
		</div>
		<ul class="list-group list-group-flush p-0">
			<li class="list-group-item">
				<a href="#" class="btn btn-primary w-100">
					Cras justo odio
				</a>
			</li>
		</ul>
		<div class="card-body">
			<a href="#" class="card-link">Card link</a>
			<a href="#" class="card-link">Another link</a>
		</div>
	</div>
</template>

<script>
    export default {
        props: [
            'profile'
        ],
    }
</script>