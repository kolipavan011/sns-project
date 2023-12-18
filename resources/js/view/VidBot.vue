<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Vidbot"></PageHeader>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" placeholder="Keyword .." aria-describedby="button-addon2" v-model="keyword">
                        <button class="btn btn-primary" type="button" @click="searchVideo()">Search</button>
                    </div>
                </div>
            </div>
            <div v-show="!loading" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                <div class="col" v-for="(item, index) in items" :key="index">
                    <div class="card">
                        <img :src="item.snippet.thumbnails.high.url" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <p class="card-text small">{{ item.snippet.title }}</p>
                                </div>
                                <div class="col-3">
                                    <button :class="item.class" class="btn btn-primary d-block fw-bold float-end" type="button" @click="addVideo(item)">{{ item.class == 'btn-warning' ? '@' : '+' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="loading" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                <div class="col" v-for="item in [1,2,3,4,5,6]">
                    <div class="card">
                        <div class="placeholder-glow">
                            <div class="placeholder col-12" style="height: 200px;"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-12"></span>
                            </h5>
                            <p class="card-text placeholder-glow">
                                <span class="placeholder col-12"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item" v-show="currentPage !== 0 && pages.length > 0">
                                <a class="page-link" href="#" @click.prevent="prevPage">Previous</a>
                            </li>
                            <li class="page-item" v-for="(item, index) in pages" :key="index">
                                <a class="page-link" href="#" @click="toPage(index)">{{ index + 1 }}</a>
                            </li>
                            <li class="page-item" v-show="pages.length > 0">
                                <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import { YoutubeDataAPI } from 'youtube-v3-api/dist';
import extend from "lodash/extend";
import NProgress from "nprogress";
const youtube = new YoutubeDataAPI('AIzaSyBTX1j2o0wV9YC9c9VORGEC6LuQOyxiEgc');

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
    },
    data() {
        return {
            keyword: "whatsapp hanuman status video",
            items: [],
            pages: [],
            loading: false,
            currentPage : 0
        }
    },
    methods: {
        searchVideo() {
            this.pages = [];
            this.currentPage = 0;
            this.fetchList();
        },
        fetchList(params = {}) {
            this.loading = true;
            this.items = [];

            let parts = extend({ type: 'video' }, params);

            youtube.searchAll(this.keyword, 50, parts)
                .then(data => {
                    this.pages.push(data);
                    this.currentPage = this.pages.length - 1;
                    this.items = this.pages[this.currentPage].items.map(value => {
                        value.class = 'btn-primary';
                        return value;
                    });
                    this.loading = false;
                }, err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        nextPage() {
            if ((this.currentPage + 1) < this.pages.length) {
                this.toPage(this.currentPage + 1);
                return false;
            }
            let token = this.pages[this.currentPage].nextPageToken;
            this.fetchList({ pageToken: token });
        },
        prevPage() {
            this.loading = true;
            this.currentPage = this.currentPage - 1;
            this.items = this.pages[this.currentPage].items;
            this.loading = false;
        },
        toPage(page) {
            if (page === this.currentPage) return;
            this.items = this.pages[page].items;
            this.currentPage = page;
        },
        addVideo(item) {
            item.class = 'btn-warning';
            NProgress.start();
            this.request()
                .get('/ytdownload/' + item.id.videoId)
                .then(({ data }) => {
                    item.class = 'btn-info';
                    NProgress.done();
                    this.$toast.success('Video Added ..!');
                })
                .catch(err => {
                    item.class = 'btn-primary';
                    console.log(err);
                    NProgress.done();
                    this.$toast.error('Something wrong happened ..!');
                });
        }

    }
}
</script>