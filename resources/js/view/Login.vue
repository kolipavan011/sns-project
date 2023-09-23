<template>
    <PageMain>
        <template v-slot:content>
            <!-- No Media Found -->
            <div class="d-flex justify-content-center align-items-center mb-5">
                <div class="card" style="width: 400px;">
                    <div class="card-header pt-4 bg-primary text-white">
                        <h5 class="card-title text-uppercase text-center">Login to Vidmin</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email address</label>
                                <input v-model="data.email" type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input v-model="data.password" type="password" class="form-control" id="loginPassword">
                            </div>
                            <div class="mb-3 form-check">
                                <input v-model="data.remember" type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    </div>
            </div>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
    },
    data() {
        return {
            data: {}    
        }
    },
    methods: {
        login2() {
            this.request().post('/login', this.data)
                .then(data => {
                    this.$toast.success('Logged In ..!')
                    console.log(resp);
                })
                .catch(err => {
                    this.$toast.error(err.message);
                });  
        },
        login() {
            this.$auth.login({data: this.data})
                .then(resp => {
                    this.$toast.success('Logged in ..!')
                })
                .catch(err => {
                    this.$toast.error('Try again ..!')
                });
        }
    },  
    mounted() {
        document.body.setAttribute('data-sidebar', 'true');
    },
    unmounted() {
        console.log(this.$auth.user());
        document.body.removeAttribute('data-sidebar');
    }
}
</script>