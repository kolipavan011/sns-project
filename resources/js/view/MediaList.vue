<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Media"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- toolbar -->
            <div class="page__tool mb-5">
                <div class="d-flex justify-content-end">
                    <div class="me-auto">
                        <a type="button" class="btn btn-primary text-uppercase fw-bold me-2">Upload</a>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="1">All</option>
                            <option value="2">Video</option>
                            <option value="2">Image</option>
                        </select>
                    </div>
                    <div class="ms-2">
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="1">All</option>
                            <option value="2">Today</option>
                            <option value="2">Week</option>
                            <option value="2">Month</option>
                            <option value="2">Year</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- list table -->
            <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-5 g-4 mb-5">
                <div class="col" v-for="item in list">
                    <div class="card">
                        <img 
                            :src="'http://storynstatus.test/storage/2023/'+item" 
                            class="card-img-top img-fluid"
                            loading="lazy"
                        >
                        <div class="card-body p-1">
                            <p class="card-text text-truncate" :title="item"><small class="text-muted">{{ item }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- No Media Found -->
            <div v-if="false"  class="d-flex justify-content-center align-items-center mb-5">
                <div class="card p-5">
                  <div class="card-body text-center">
                    <h5 class="card-title">No Media Found</h5>
                    <p class="card-text text-muted">Let`s upload media here. you can find useful video, images and much more here. To upload media file click on upload button and select file you want to upload ..!</p>
                  </div>
                </div>
            </div>
            <!-- pagination -->
            <div class="page__pagination d-flex justify-content-center pb-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    </ul>
                </nav>
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
        PageHeader,
    },
    data() {
        return {
            list: [],
        }
    },
    methods: {
        fetchMedia() {
            this.list = [...Array.from({ length: 9 }, (x, i) => (i + 31)+'.jpg'), ...Array.from({ length: 9 }, (x, i) => (i + 31) + '.jpg')]
        }
    },
    mounted() {
        this.fetchMedia();
    }
}
</script>