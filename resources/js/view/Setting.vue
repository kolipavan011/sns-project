<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Setting"></PageHeader>
        </template>
        <template v-slot:content>
            <main v-if="ready">
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
                            <input v-model="setting.favicon" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Website Logo</label>
                            <input v-model="setting.logo" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Header Navbar</label>
                            <VueMultiselect
                            v-model="setting.navbar"
                            :options="options"
                            :multiple="true"
                            :taggable="true"
                            :close-on-select="false"
                            label="title"
                            track-by="slug"
                            >
                            </VueMultiselect>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" @click="update">{{loadingText}}</button>
                    </div>
                </div>
            </main>
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
            ready:false,
            loadingText: 'Update',
            options: [],
            setting: {
                favicon: null,
                logo: null,
                navbar: []
            }
        }
    },
    methods: {
        update() {
            this.loadingText = 'Updating...';
            this.request().post('/setting/store', this.setting)
                .then(resp => {
                    this.$toast.success('Updated ..!');
                    this.loadingText = 'Update';
                })
                .catch(err => {
                    this.loadingText = 'Update';
                    this.$toast.error(err.message);
                });
        },
        fetchSetting() {
            this.ready = false;
            this.request().get('/setting')
                .then(({data}) => {
                    this.setting = data.setting;
                    this.options = data.category;
                    this.ready = true;
                })
                .catch(err => {
                    this.$toast.error(err.message);
                });
        },
    },
    created() {
        this.fetchSetting();
        this.options = storynstatus.category;

    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>