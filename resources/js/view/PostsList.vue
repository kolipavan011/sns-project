<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Posts"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- content -->
            <PageContent></PageContent>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import PageContent from '../components/PageContent.vue'

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        PageContent
    }
}
</script>