<template>
	<div class="card text-center overflow-hidden theme mb-4"
	     :class="{'theme-pro': theme.is_pro, 'theme-selected': theme.selected}">
		<span class="rounded-circle btn btn-success position-absolute theme-checked" v-if="theme.selected">
			<i class="fas fa-check"></i>
		</span>

		<div class="theme-content">
			<img :src="theme.thumbnail" :alt="theme.name" class="img-fluid">
			<div class="card-footer font-weight-600">
				{{theme.name}}
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props: ['theme'],
    }
</script>