<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Media"></PageHeader>
        </template>
        <template v-slot:content>
            <!-- toolbar -->
            <div class="page__tool mb-4">
                <div class="d-flex justify-content-end">
                    <div class="me-auto">
                        <a type="button" class="btn btn-primary text-uppercase fw-bold me-2">Upload</a>
                    </div>
                    <div>
                        <select @change="fetchMedia" v-model="filter.type" class="form-select" aria-label="Default select example">
                            <option value="all">All</option>
                            <option value="video">Video</option>
                            <option value="image">Image</option>
                        </select>
                    </div>
                    <div class="ms-2">
                        <select @change="fetchMedia" v-model="filter.duration" class="form-select" aria-label="Default select example">
                            <option value="all">All</option>
                            <option value="today">Today</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->
            <div class="row mb-2">
                <div class="col-12 mb-3">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb border-bottom border-top py-3">
                        <li class="breadcrumb-item" v-for="i in folderStack">{{ i.name }}</li>
                      </ol>
                    </nav>
                </div>
            </div>
            <!-- list grid -->
            <div class="row row-cols-2 row-cols-sm-4 row-cols-md-4 row-cols-lg-6 g-4 mb-5">
                <!-- prev btn -->
                <div class="col" v-if="folderStack.length > 1">
                    <div class="card border-0">
                        <a @click="prev()">
                            <img 
                                src="/storage/prev-folder.png" 
                                class="media-image"
                                loading="lazy"
                            >
                        </a>
                        <div class="card-body p-1">
                            <p class="card-text text-center text-truncate" title="Back"><small class="text-muted">Go Back</small></p>
                        </div>
                    </div>
                </div>
                <!-- loading placeholder -->
                <div class="col" v-for="i in [1,2,3,4,5,6]" v-if="loading">
                    <div class="card border-0" aria-hidden="true">
                        <img 
                            class="media-image"
                            loading="lazy"
                        >
                        <div class="card-body p-1">
                            <p class="card-text text-center placeholder-glow">
                                <span class="placeholder placeholder-xs col-12"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- media list -->
                <div class="col" v-for="media in list">
                    <div class="card border-0">
                        <a href="#" @click.prevent="media.detail ? showModal() : next(media)">
                            <img 
                                :src="media.detail ? media.path : folderIcon" 
                                class="media-image"
                                loading="lazy"
                            >
                        </a>
                        <div class="card-body p-1">
                            <a class="text-decoration-none" @click.prevent="renameMedia(media)">
                                <p class="card-text text-center text-truncate text-muted" :title="media.name">{{ media.detail ? media.detail.name : media.name }}</p>
                            </a>
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
            <!-- Models -->
            <div class="models-section">
                <MediaModal ref="mediaModal"></MediaModal>
            </div>
        </template>
    </PageMain>
</template>
<script>
import { Modal } from "bootstrap/dist/js/bootstrap.esm.min";
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import MediaModal from '../components/modals/MediaModal.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        MediaModal
    },
    data() {
        return {
            model: undefined,
            loading: false,
            folderIcon: '/storage/next-folder.png',
            folderStack: [{id: '00000000-00000000-00000000-00000000', name: 'Home' }],
            folder: {},
            list: [],
            filter: {
                type: 'all',
                duration: 'all',
            }
        }
    },
    methods: {
        fetchMedia() {
            this.loading = true;
            this.list.length = 0
            this.filter.folder = this.folderStack[this.folderStack.length - 1].id;
            this.request()
                .get('/media', { params: this.filter })
                .then(({data}) => {
                    this.list = data;
                    this.loading = false;
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                  });
        },
        next(media) {
            if (media.detail !== undefined) return;
            this.folderStack.push(media);
            this.fetchMedia();
        },
        prev() {
            if (this.folderStack.length > 1) this.folderStack.pop();
            this.fetchMedia();
        },
        showModal() {
           this.model.show();
        },
        renameMedia(media) {
            let name = prompt('Get give a name',  media.detail ?  media.detail.name :  media.name );
            if (!name) return;
            if (media.detail)
                media.detail.name = name;
            else
                this.request()
                    .post('/media/'+ media.id, {folder : name})
                    .then(resp => {
                        media.name = name;
                        this.$toast.success('Changed SuccessFully')
                    })
                    .catch(err => this.$toast.error('Something wents wrong'));
        }
    },
    mounted() {
        this.fetchMedia();
        this.model = new Modal(this.$refs.mediaModal.$el);
    }
}
</script>
<style>
.media-image {
    width: 100%;
    aspect-ratio: 1/1;
    border-radius: 10px;
    background-color: #ccc;
}
</style>