<template>
    <div>
        <!-- toolbar -->
        <div class="page__tool mb-5">
            <div class="d-flex justify-content-end">
                <div class="me-auto">
                    <a type="button" class="btn btn-primary text-uppercase fw-bold me-2">Add</a>
                    <a v-if="false" type="button" class="btn btn-danger text-uppercase fw-bold">Delete</a>
                </div>
                <div class="ms-2">
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
                    <h4 class="card-title">{{item.title}} Lorem ipsum dolor sit amet consectetur.</h4>
                    <p class="card-text text-muted">Created by Pavan Koli, 12 days ago</p>
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
                    <li class="page-item" :class="{ active : link.active}" v-if="links.url !== null" v-for="link in links">
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
    methods: {
        fetchList(page) {
            this.list.length = 0;
            this.links.length = 0;
            this.loading = true;
            this.error = false;
            this.request()
                .get('/posts', {
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