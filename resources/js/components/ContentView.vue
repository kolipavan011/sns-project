<template>
    <div class="content-edit">
        <div class="row">
            <div class="col-12 mb-4">
                <h3 class="fw-bold mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, consectetur.</h3>
                <div class="d-flex justify-content-between pb-4 align-items-center border-bottom">
                    <p class="text-muted text-uppercase fw-bold mb-0 pr-2 text-truncate">published on a month ago</p>
                    <button type="button" class="btn btn-sm btn-primary">Apply</button>
                </div>
            </div>
        </div>
        <!-- toolbar -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <div class="me-auto">
                        <a type="button" class="btn btn-small btn-primary text-uppercase fw-bold me-2">Upload</a>
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
        </div>
        <!-- Media List View -->
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
    </div>
</template>
<script>


export default {
    name: 'ContentView',
    data() {
        return {
            list: [],
        }
    },
    methods: {
        fetchMedia() {
            this.list = [...Array.from({ length: 9 }, (x, i) => (i + 31) + '.jpg'), ...Array.from({ length: 9 }, (x, i) => (i + 31) + '.jpg')]
        }
    },
    mounted() {
        this.fetchMedia();
    }
}
</script>