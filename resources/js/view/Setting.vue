<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Setting"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- No Media Found -->
            <div class="row col-12">
                <div class="card border-0 px-0 mb-4">
                  <div class="card-body">
                    <h5 class="card-title">Website</h5>
                    <p class="card-text text-secondary">Change setting for website</p>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Website Favicon Url</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Header Navbar</label>
                        <VueMultiselect
                         v-model="selected"
                         :options="options"
                         :multiple="true"
                         :taggable="true"
                         label="title"
                         track-by="slug"
                        >
                        </VueMultiselect>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
            </div>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import VueMultiselect from 'vue-multiselect';


export default {
    name: 'Setting',
    components: {
        PageMain,
        PageHeader,
        VueMultiselect
    },
    data() {
        return {
            email: '',
            name: '',
            loadingText: 'Update',
            options: [],
            selected:null,
        }
    },
    methods: {
        login() {
            this.loadingText = 'Updating...';
            this.request().post('/user', {
                email: this.email,
                name: this.name,
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
        this.options = storynstatus.category;

    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>