<template>
    <div class="content-edit">
        <div class="row">
            <div class="col-12 mb-4 border-bottom">
                <div class="card-body pb-3" v-if="!post.id">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                    </p>
                </div>
                <div class="card border-0" v-else>
                  <div class="card-body px-0">
                    <h5 class="card-title fw-bold text-secondary">{{ post.title }}</h5>
                    <p class="card-text text-muted">Created {{ $filters.timeAgo(post.created_at) }} in love status, sad status</p>
                  </div>
                </div>
            </div>
        </div>
        <!-- toolbar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <div class="me-auto">
                        <a v-show="allowSelection" type="button" class="btn btn-danger text-uppercase fw-bold me-2" @click="doAllowSelection">Unselect</a>
                    </div>
                    <div>
                        <a v-show="allowSelection" type="button" class="btn btn-primary text-uppercase fw-bold me-2" @click="applySelection">Apply({{ selection.length }})</a>
                    </div>
                    <div class="ms-2">
                        <a type="button" v-show="!allowSelection" @click="doAllowSelection" class="btn btn-primary text-uppercase fw-bold me-2">Select</a>
                    </div>
                    <div class="ms-2" v-if="allowSelection">
                        <select @change="fetchMedia" class="form-select" aria-label="Default select example">
                            <option value="all">All</option>
                            <option value="today">Today</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="row mb-4" v-if="allowSelection">
            <div class="col-12 border-bottom border-top py-2 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" v-for="i in folderStack">{{ i.name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Media List View -->
        <div class="row row-cols-2 row-cols-sm-4 row-cols-lg-5 g-4 mb-5">
            <!-- prev btn -->
            <div class="col" v-if="folderStack.length > 1 && allowSelection">
                <div class="card border-0">
                    <a @click="prevFolder()">
                        <img 
                            src="/img/prev-folder.png" 
                            class="media-image"
                            loading="lazy"
                        >
                    </a>
                    <div class="card-body p-1">
                        <p class="card-text text-center text-truncate" title="Back"><small class="text-muted">Go Back</small></p>
                    </div>
                </div>
            </div>
            <!-- loader -->
            <div class="col" v-if="loading && allowSelection">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-secondary" style="width: 4.5rem; height: 4.5rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- List of Item -->
            <div class="col" v-for="item in list">
                <div class="card border-0" @click="handleClick(item)">
                    <img 
                        :src="item.preview" 
                        class="card-img-top img-fluid thumbnail border-primary"
                        :class="{'is-selected': isSelected(item.id) && allowSelection}"
                        loading="lazy"
                    >
                    <div class="card-body p-1">
                        <p class="card-text text-truncate text-center" :title="item.name"><small class="text-muted">{{ item.name }}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loader -->
        <div class="row">
            <div class="col-12" v-show="loading && !allowSelection">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-secondary" style="width: 4.5rem; height: 4.5rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-section">
            <VideoModal :video="video" ref="videoModal" @response="detachVideo"/>
        </div>
    </div>
</template>
<script>
import { Modal, Dropdown } from "bootstrap/dist/js/bootstrap.esm.min";
import VideoModal from "./modals/VideoModal.vue";

export default {
    name: 'ContentView',
    components: {
        VideoModal,
    },
    data() {
        return {
            videoModal: undefined,
            allowSelection: false,
            video:{},
            loading: false,
            duration:'all',
            id: this.$route.params.id,
            post: {
                id: false,
                created_at: new Date().toJSON(),
                title:null,
            },
            list: [],
            selection:[],
            folderStack: [{
                id: '00000000-00000000-00000000-00000000',
                name: 'Home',
                file: '/storage/next-folder.png',
                type: 'folder'
            }],
        }
    },
    methods: {
        fetchPost() {
            this.request()
                .get('posts/' + this.id +'/show')
                .then(({ data }) => {
                    this.post = data;
                    data.videos.forEach(item => this.selection.push(item.id));
                })
                .catch(err => console.log(err));
        },
        fetchMedia() {
            let endPoint = '/posts/' + this.id + '/videos';
            let filter = {duration:this.duration};

            if (this.allowSelection) {
                endPoint = '/folder';
                filter.type = 'video';
                filter.duration = 'all';
                filter.folder = this.currentFolder();
            }
          
            this.list.length = 0;
            this.loading = true;
            this.request()
                .get(endPoint,{params : filter})
                .then(({ data }) => {
                    this.loading = false;
                    this.list = data.map(item => {
                        if (item.type == undefined) {
                            item.type = 'folder';
                            item.preview = '/img/next-folder.png';
                        }
                        return item;
                    });
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                });
        },
        handleClick(item) {
            if (item.type == 'folder') {
                return this.nextFolder(item);
            }

            if (this.allowSelection) {
                this.toggleToSelection(item.id)
            } else {
                this.video = item;
                this.videoModal.show();
            }
        },
        doAllowSelection() {
            this.allowSelection = !this.allowSelection;
            this.folderStack.splice(1, this.folderStack.length);
            this.fetchMedia();
        },
        prevFolder() {
            if (this.folderStack.length > 1) this.folderStack.pop();
            this.fetchMedia();
        },
        nextFolder(folder) {
            this.folderStack.push(folder);
            this.fetchMedia();
        },
        currentFolder() {
            return this.folderStack[this.folderStack.length - 1].id;
        },
        toggleToSelection(id) {
            if (this.selection.indexOf(id) >= 0) {
                this.selection.splice(this.selection.indexOf(id), 1);
            } else {
                this.selection.push(id);
            }
        },
        isSelected(id) {
            return (this.selection.indexOf(id) >= 0);
        },
        applySelection() {
            this.$toast.info('Videos Sync...');

            this.request()
                .post('posts/' + this.id + '/videos-sync', {
                    videos:this.selection
                })
                .then(({ data }) => {
                    this.doAllowSelection();
                    this.$toast.success('Videos Sync Success');
                })
                .catch(err => {
                    this.$toast.error('error');
                    console.log(err);
                });
        },
        detachVideo() {
            this.$toast.info('Videos Detaching...');

            this.request()
                .post('posts/' + this.id + '/videos-detach', {
                    videoid: this.video.id
                })
                .then(({ data }) => {
                    this.videoModal.hide();
                    this.toggleToSelection(this.video.id);
                    this.fetchMedia();
                    this.$toast.success('Videos Detach Success');
                })
                .catch(err => {
                    this.$toast.error('error');
                    console.log(err);
                });
        }
    },
    mounted() {
        this.videoModal = new Modal(this.$refs.videoModal.$el);
        this.fetchPost();
        this.fetchMedia();
    }
}
</script>
<style lang="scss">
.thumbnail {
    aspect-ratio: 1 / 1;
    object-fit: contain;

    &.is-selected {
        padding: 10px;
        border-style: solid;
    }
}
</style>