<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Post Editer">
                <template v-slot:option>
                    <li class="dropdown-item text-primary">Publish</li>
                </template>
            </PageHeader>
        </template>
        <template v-slot:content>
            <main class="content-edit" v-if="isReady">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Title</label>
                            <input v-model="post.title" type="text" class="form-control" placeholder="Post title">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Slug</label>
                            <input v-model="post.slug" type="email" class="form-control" placeholder="Post slug ...">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Category</label>
                            <select v-model="post.category" class="form-control" multiple>
                            <label for="exampleInputPassword1" class="form-label">Tags</label>
                                <option :value="opt.id" v-for="opt in tags">{{ opt.title }}</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Tags</label>
                            <select v-model="post.tags" class="form-control" multiple>
                                <option :value="opt.id" v-for="opt in tags">{{ opt.title }}</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Feature Image</label>
                            <input v-model="post.featured_image" type="text" class="form-control" placeholder="Add Feature Image Url">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Seo Title</label>
                            <input v-model="post.meta.title" type="text" class="form-control" placeholder="Seo title here ..">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Seo Keywords</label>
                            <input type="text" class="form-control" placeholder="Add Seo Keywords">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Seo Description</label>
                            <textarea v-model="post.meta.description" class="form-control" rows="3" placeholder="Seo Description"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Published Date</label>
                            <input v-model="post.published_at" type="date" class="form-control" placeholder="Published date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <vue-editor v-model="post.body" placeholder="Write Something ..." :editorToolbar="customToolbar"></vue-editor>
                        </div>
                    </div>
                </div>
            </main>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import { VueEditor } from "vue3-editor";
import get from "lodash/get";


export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        VueEditor,
    },

    computed: {
        creatingPost() {
            return this.$route.name === 'post-create';
        },
    },

    data() {
        return {
            select:[],
            content: "",
            customToolbar: [
                [{ header: [false, 2, 3, 4, 5, 6] }],
                ["bold", "italic", "link"],
                [{ list: "ordered" }],
            ],
            uri: this.$route.params.id || 'create',
            post: {
                id: null,
                title: null,
                slug: null,
                category: [],
                tags: [],
                featured_image: null,
                body: null,
                published_at:null,
                meta: {
                    title: null,
                    description: null,
                    keywords:[]
                },
                tags: [],
                category:[]
            },
            tags: [],
            category: [],
            isReady: false
        }
    },

    methods: {
        fetchPost() {
            return this.request()
                .get('/posts/' + this.uri)
                .then(({ data }) => {
                    this.post.id = data.post.id;
                    this.post.title = get(data.post, 'title', '');
                    this.post.slug = get(data.post, 'slug', '');
                    this.post.body = get(data.post, 'body', '');
                    this.post.category = get(data.post, 'category', []).map(item => item.id);
                    this.post.tags = get(data.post, 'tags', []).map(item => item.id);
                    this.post.published_at = get(data.post, 'published_at', '');
                    this.post.featured_image = get(data.post, 'featured_image', '');
                    this.post.meta.title = get(data.post, 'title', '');
                    this.post.meta.description = get(data.post, 'description', '');
                    this.post.meta.keywords = get(data.post, 'keywords', []);
                    this.tags = get(data, 'tags', []);
                    this.category = get(data, 'category', []);

                })
                .catch(error => console.log(error));
        },
        savePost() {
            
        }
    },

    async created() {
        await Promise.all([this.fetchPost()]);
        this.isReady = true;
    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>