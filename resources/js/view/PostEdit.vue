<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Post Editer"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- content -->
            <ContentEdit></ContentEdit>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import ContentEdit from '../components/ContentEdit.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        ContentEdit
    }
}
</script>