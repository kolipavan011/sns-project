<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Post Editer">
                <template v-slot:status>
                    <ul class="navbar-nav ms-auto pe-3">
                        <li class="nav-item">
                            <a class="btn nav-link" @click.prevent="savePost">{{ status }}</a>
                        </li>
                    </ul>
                </template>
            </PageHeader>
        </template>
        <template v-slot:content>
            <main class="content-edit" v-if="isReady">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Title</label>
                            <input @input.native="updatePost" v-model="post.title" type="text" class="form-control" placeholder="Post title">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Slug</label>
                            <input @change="slugify" v-model="post.slug" type="email" class="form-control" placeholder="Post slug ...">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Summary</label>
                            <textarea v-model="post.summary" class="form-control" rows="3" placeholder="Seo Description"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <VueMultiselect
                                v-model="post.category"
                                :options="category"
                                :multiple="true"
                                :taggable="true"
                                :close-on-select="false"
                                label="title"
                                track-by="slug"
                            >
                            </VueMultiselect>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tags</label>
                            <VueMultiselect
                                v-model="post.tags"
                                :options="tags"
                                :multiple="true"
                                :taggable="true"
                                :close-on-select="false"
                                label="title"
                                track-by="slug"
                            >
                            </VueMultiselect>
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
                            <input v-model="post.meta.keywords" type="text" class="form-control" placeholder="Add Seo Keywords">
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
                        <div class="mb-4 vidmin__editor">
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
import debounce from 'lodash/debounce';
import VueMultiselect from 'vue-multiselect';



export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        VueEditor,
        VueMultiselect
    },

    watch: {
        post: {
            handler(newPost, oldPost) {
                this.slugify();
            },
            deep: true
        }
    },

    computed: {
        creatingPost() {
            return this.$route.name === 'post-create';
        },
        isPublished() {
            return this.post.published_at !== null;
        }
    },

    data() {
        return {
            select:[],
            customToolbar: [
                [{ header: [false, 2, 3, 4, 5, 6] }],
                ["bold", "italic", "link"],
                [{ list: "ordered" }],
            ],
            status:'Save',
            uri: this.$route.params.id || 'create',
            post: {
                id: null,
                title: null,
                slug: null,
                featured_image: null,
                summary: null,
                body: null,
                published_at:null,
                meta: {
                    title: null,
                    description: null,
                    keywords:null
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
                    this.post.summary = get(data.post, 'summary', '');
                    this.post.body = get(data.post, 'body', '');
                    this.post.category = get(data.post, 'category', []);
                    this.post.tags = get(data.post, 'tags', []);
                    this.post.published_at = get(data.post, 'published_at', null);
                    this.post.featured_image = get(data.post, 'featured_image', '');
                    this.post.meta.title = get(data.post.meta, 'title', '');
                    this.post.meta.description = get(data.post.meta, 'description', '');
                    this.post.meta.keywords = get(data.post.meta, 'keywords', '');
                    this.tags = get(data, 'tags', []);
                    this.category = get(data, 'category', []);
                    this.status = get(data.post, 'published_at', null) !== null ? 'Update' : 'Save';

                })
                .catch(error => console.log(error));
        },
        savePost() {
            this.status = this.isPublished ? 'Updating' : 'Saving';

            return this.request()
                .post('/posts/' + this.post.id, this.post)
                .then(({ data }) => {
                    this.status = this.isPublished ? 'Update' : 'Save';
                    if (this.creatingPost) {
                        this.$router.push({ name: 'post-edit', params: { id: this.post.id } });
                    }
                })
                .catch(error => {
                    this.status = 'Error';
                    setTimeout(() => {
                        this.status = this.isPublished ? 'Update' : 'Save';
                    }, 3000);
                    console.log(error);
                });
        },

        updatePost : debounce(function () {
            this.savePost();
        }, 3000),

        slugify() {
            let text = this.post.slug.toString().toLowerCase().trim();

            const sets = [
                { to: 'a', from: '[ÀÁÂÃÄÅÆĀĂĄẠẢẤẦẨẪẬẮẰẲẴẶ]' },
                { to: 'c', from: '[ÇĆĈČ]' },
                { to: 'd', from: '[ÐĎĐÞ]' },
                { to: 'e', from: '[ÈÉÊËĒĔĖĘĚẸẺẼẾỀỂỄỆ]' },
                { to: 'g', from: '[ĜĞĢǴ]' },
                { to: 'h', from: '[ĤḦ]' },
                { to: 'i', from: '[ÌÍÎÏĨĪĮİỈỊ]' },
                { to: 'j', from: '[Ĵ]' },
                { to: 'ij', from: '[Ĳ]' },
                { to: 'k', from: '[Ķ]' },
                { to: 'l', from: '[ĹĻĽŁ]' },
                { to: 'm', from: '[Ḿ]' },
                { to: 'n', from: '[ÑŃŅŇ]' },
                { to: 'o', from: '[ÒÓÔÕÖØŌŎŐỌỎỐỒỔỖỘỚỜỞỠỢǪǬƠ]' },
                { to: 'oe', from: '[Œ]' },
                { to: 'p', from: '[ṕ]' },
                { to: 'r', from: '[ŔŖŘ]' },
                { to: 's', from: '[ßŚŜŞŠ]' },
                { to: 't', from: '[ŢŤ]' },
                { to: 'u', from: '[ÙÚÛÜŨŪŬŮŰŲỤỦỨỪỬỮỰƯ]' },
                { to: 'w', from: '[ẂŴẀẄ]' },
                { to: 'x', from: '[ẍ]' },
                { to: 'y', from: '[ÝŶŸỲỴỶỸ]' },
                { to: 'z', from: '[ŹŻŽ]' },
                { to: '-', from: "[·/_,:;']" },
            ];

            sets.forEach((set) => {
                text = text.replace(new RegExp(set.from, 'gi'), set.to);
            });

            return this.post.slug = text
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w-]+/g, '') // Remove all non-word chars
                .replace(/--+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        },
    },

    async created() {
        await Promise.all([this.fetchPost()]);
        this.isReady = true;
    },
}
</script>