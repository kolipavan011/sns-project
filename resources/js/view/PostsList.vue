<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Posts"></PageHeader>
        </template>
        <template v-slot:content>
            <div class="page__tool mb-4">
                <div class="d-flex justify-content-end">
                    <div>
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="1">All Posts</option>
                            <option value="2">Your Posts</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-md border-top">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
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
        PageHeader
    }
}
</script>