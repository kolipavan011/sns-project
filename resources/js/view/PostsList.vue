<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Posts">
                <template v-slot:option>
                    <router-link 
                        :to="{ name: 'post-create'}" 
                        class="dropdown-item"
                    >
                        New Post
                    </router-link>
                    <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                </template>
            </PageHeader>
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