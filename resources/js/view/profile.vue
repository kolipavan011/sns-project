<template>
    <PageMain>
        <template v-slot:head>
          <PageHeader title="Profile"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- No Media Found -->
            <div class="d-flex justify-content-center align-items-center mb-5" style="min-height: 500px;">
                <div class="card" style="width: 400px;">
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input v-model="name" type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input v-model="email" type="email" class="form-control" id="loginEmail" autocomplete="off" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ loadingText }}</button>
                        </form>
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
        PageHeader
    },
    data() {
        return {
            email: '',
            name:'',
            loadingText: 'Update'
        }
    },
    methods: {
        login() {
            this.loadingText = 'Updating...';
            this.request().post('/user', {
                email : this.email,
                name : this.name,
            })
                .then(resp => {
                    storynstatus.user.name = this.name;
                    storynstatus.user.email = this.email;
                    this.$toast.success('Updated ..!');
                    this.loadingText = 'Update';
                })
                .catch(err => {
                    this.loadingText = 'Update';
                    this.$toast.error(err.message);
                });
        },
    },
    created() {
        let { name, email } = storynstatus.user;
        this.email = email;
        this.name = name;
    }
}
</script>