<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Category">
                <template v-slot:option>
                    <router-link 
                        :to="{ name: 'category-create'}" 
                        class="dropdown-item"
                    >
                        New Category
                    </router-link>
                </template>
            </PageHeader>
        </template>
        <template v-slot:content>
            <!-- content -->
            <PageContent uri="/category"></PageContent>
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
    },
    data() {
        return {}
    }
}
</script>