<template>
	<div class="card text-center overflow-hidden" :class="{'theme-pro': theme.is_pro}">
		<img :src="theme.thumbnail" :alt="theme.name" class="img-fluid">
		<span class="rounded-circle btn btn-success position-absolute" v-if="theme.selected">
			<i class="fas fa-check"></i>
		</span>

		<div class="card-footer font-weight-600">
			{{theme.name}}
		</div>
	</div>
</template>

<script>
    export default {
        props: ['theme'],
        methods: {

        }
    }
</script>