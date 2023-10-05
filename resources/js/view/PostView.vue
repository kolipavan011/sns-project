<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Post View"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- content -->
            <ContentView></ContentView>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import ContentView from '../components/ContentView.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        ContentView
    }
}
</script>