<template>
    <div>
        <!-- toolbar -->
        <div class="page__tool mb-5">
            <div class="d-flex justify-content-end">
                <div class="ms-2" v-if="uri == '/posts'">
                    <select v-model="status" class="form-select" @change="fetchList(1)">
                        <option selected value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="ms-2">
                    <select v-model="scope" class="form-select" @change="fetchList(1)" >
                        <option selected value="all">All Posts</option>
                        <option value="user">Your Posts</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Card List -->
        <div class="card__list mb-5">
            <div class="card border-0" v-if="!loading && !error">
                <div class="card-body border" v-for="item in list">
                    <router-link :to="{ name : viewer, params : {id: item.id}}" class="text-decoration-none text-dark">
                        <h4 class="card-title">{{item.title}}</h4>
                    </router-link>
                    <p class="card-text text-muted">Created {{ $filters.timeAgo(item.created_at) }}</p>
                </div>
                <div class="card-body p-5 border text-center" v-if="list.length == 0">
                    <h4 class="card-title text-muted  text-uppercase mb-5">No Post Found. Create post first ..!</h4>
                    <button @click="fetchList(1)" class="btn btn-primary">refresh</button>
                </div>
            </div>
            <div class="card" v-else>
                <div class="card-body p-5 text-center" v-if="error">
                    <h4 class="card-title text-muted  text-uppercase mb-5">Something went`s wrong</h4>
                    <button @click="fetchList(1)" class="btn btn-primary">refresh</button>
                </div>
                <div class="card-body" v-if="loading">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- pagination -->
        <div class="row page__pagination mb-5" v-if="links.length > 0 && list.length > 0">
            <nav aria-label="Page navigation">
                <ul class="pagination flex-wrap justify-content-center">
                    <li class="page-item" :class="{ active : link.active}"  v-for="link in links">
                        <a class="page-link" href="#" v-html="link.label" @click.prevent="fetchList(link.label)"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ContentList',
    props: ['uri'],
    data() {
        return {
            loading: false,
            error: false,
            list: [],
            links : [],
            status: 'published',
            scope: 'all',
        }
    },
    computed: {
        viewer() {
            switch (this.uri) {
                case '/posts':
                    return 'post-view';
                case '/tags':
                    return 'tag-edit';
                case '/category':
                    return 'category-edit';
                default:
                    return 'post-view';
            }

            return 'post-view';
        }  
    },
    methods: {
        fetchList(page) {
            this.list.length = 0;
            this.links.length = 0;
            this.loading = true;
            this.error = false;
            this.request()
                .get(this.uri, {
                    params: {
                        page: page,
                        scope: this.scope,
                        status: this.status
                    }
                }).then(({ data }) => {
                    this.loading = false;
                    this.list = data.data;
                    this.links = data.links;
                }).catch(error => {
                    this.loading = false;
                    this.error = true;
                    this.links.length = 0;
                    console.log(error);
                });      
        }
    },
    created() {
        this.fetchList(1);
    }
}
</script>