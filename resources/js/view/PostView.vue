<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Post View">
                <template v-slot:option>
                    <router-link 
                        :to="{ name: 'post-edit',params:{ id: post}}" 
                        class="dropdown-item"
                    >
                        Edit
                    </router-link>
                    <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                </template>
            </PageHeader>
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
    data() {
        return {
            post:this.$route.params.id
        }
    },
    components: {
        PageMain,
        PageHeader,
        ContentView
    }
}
</script>