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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
                <div class="col" v-for="item in Array.from({length:9},(x,i) => i+31)">
                    <div class="card">
                        <img :src="'http://storynstatus.test/storage/2023/'+item+'.jpg'" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h6 class="card-title">File {{ item }} <span class="text-muted">({{ Math.round(Math.random(1, 9) * 2) }} MB)</span></h6>
                            <div class="d-flex justify-content-between">
                                <p class="card-text mb-2"><small class="text-muted">12 days ago</small></p>
                                <a type="button" class="media__delete d-none btn btn-danger btn-sm">Delete</a>
                            </div>
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
        return {}
    },
    mounted() {
        console.log(this.$route.name)
    }
}
</script>