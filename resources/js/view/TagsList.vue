<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Tags">
                <template v-slot:option>
                    <router-link 
                        :to="{ name: 'tag-create'}" 
                        class="dropdown-item"
                    >
                        New Tag
                    </router-link>
                </template>
            </PageHeader>
        </template>
        <template v-slot:content>
            <!-- content -->
            <PageContent uri="/tags"></PageContent>
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