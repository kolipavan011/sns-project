<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Vidbot"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- No Media Found -->
            <div class="d-flex justify-content-center align-items-center mb-5">
                <div class="card p-5">
                    <div class="card-body text-center">
                    <h5 class="card-title">No Media Found</h5>
                    <p class="card-text text-muted">Let`s upload media here. you can find useful video, images and much more here. To upload media file click on upload button and select file you want to upload ..!</p>
                    </div>
                </div>
            </div>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
    },
    data() {
        return {}
    },
    mounted() {
        console.log(this.$route.name)
    }
}
</script>