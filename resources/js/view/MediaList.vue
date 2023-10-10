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
                        <a type="button" class="btn btn-primary text-uppercase fw-bold me-2" @click="uploadModalShow">Upload</a>
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
            <div class="row mb-4">
                <div class="d-flex justify-content-between col-12 border-bottom border-top py-2 align-items-center">
                    <div>
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item" v-for="i in folderStack">{{ i.name }}</li>
                          </ol>
                        </nav>
                    </div>
                    <div class="dropdown dropstart">
                        <button class="btn border-0" type="button" @click="dropdown">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="25"
                                class="icon-dots-horizontal"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm7 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm7 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                                />
                            </svg>
                        </button>
                        <ul class="dropdown-menu" ref="dropdown">
                            <li>
                                <a 
                                    class="dropdown-item"
                                    :class="{active: bulkSelect}"
                                    @click.prevent="selectMedia"
                                    href="#"
                                >
                                    Select
                                </a>
                            </li>
                            <li><a href="#" class="dropdown-item" @click.prevent="moveMedia" v-show="selection.length == 0">Move</a></li>
                            <li><a href="#" class="dropdown-item" @click.prevent="pasteMedia" v-show="selection.length > 0">Paste</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item" @click.prevent="createFolder">Create Folder</a></li>
                        </ul>
                    </div>
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
                <!-- media list -->
                <div class="col" v-for="media in list">
                    <div class="card border-0">
                        <a href="#" @click.prevent="handleClick(media)">
                            <img 
                                :src="media.detail ? media.path : folderIcon" 
                                class="media-image border-3 border-primary"
                                :class="{is_selected: media.isSelected }"
                                loading="lazy"
                            >
                        </a>
                        <div class="card-body p-1">
                            <a href="#" class="text-decoration-none" @click.prevent="showModal(media)">
                                <p class="card-text text-center text-truncate text-muted" :title="media.name">{{ media.name }}</p>
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
                <MediaModal :item="modalItem" ref="mediaModal" @modalResponse="modalResponse"></MediaModal>
                <upload-modal ref="uploadModal" :folder="getCurrentFolder"></upload-modal>
            </div>
        </template>
    </PageMain>
</template>
<script>
import { Modal, Dropdown } from "bootstrap/dist/js/bootstrap.esm.min";
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';
import MediaModal from '../components/modals/MediaModal.vue';
import UploadModal from '../components/modals/UploadModal.vue';

export default {
    name: 'PostList',
    components: {
        PageMain,
        PageHeader,
        MediaModal,
        UploadModal
    },
    computed : {
        getCurrentFolder() {
            return this.folderStack[this.folderStack.length - 1].id;
        }  
    },
    data() {
        return {
            Modal: undefined,
            fileUploadModal:undefined,
            Dropdown: undefined,
            bulkSelect: false,
            modalItem: {},
            selection: [],
            loading: false,
            folderIcon: '/storage/next-folder.png',
            folderStack: [{
                id: '00000000-00000000-00000000-00000000',
                name: 'Home',
                file: '/storage/next-folder.png',
                type: 'folder'
            }],
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
                .get('/folder', { params: this.filter })
                .then(({data}) => {
                    this.list = data.map(item => {
                        item.isSelected = false;
                        return item;
                    });
                    this.loading = false;
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                  });
        },
        uploadModalShow() {
            this.fileUploadModal.show();
        },
        handleClick(media) {
            if (this.bulkSelect) return media.isSelected = !media.isSelected;
            if (media.type == "media") return this.showModal(media);
            this.next(media);
        },
        selectMedia(id) {
            this.bulkSelect = !this.bulkSelect;
            this.selection.length = 0;
            this.list.forEach(item => (item.isSelected = false));
            this.Dropdown.toggle();

        },
        next(media) {
            if (media.type !== 'folder') return;
            this.folderStack.push(media);
            this.fetchMedia();
        },
        prev() {
            if (this.folderStack.length > 1) this.folderStack.pop();
            this.fetchMedia();
        },
        moveMedia() {
            this.list.forEach(item => {
                if(item.isSelected) this.selection.push(item);
            })
            this.bulkSelect = false;
            this.Dropdown.toggle();
        },
        pasteMedia() {
            this.Dropdown.toggle();

            if (this.selection.length === 0) return (this.bulkSelect = false);

            let currentFolder = this.folderStack[this.folderStack.length - 1].id;
            let folder = [], files = [];

            this.selection.forEach(item => {
                if (item.type == 'folder') folder.push(item.id);
                else files.push(item.id);
            })

            this.request()
                .post('/folder/' + currentFolder + '/paste', { 
                    folder: folder,
                    files: files
                 })
                .then(({ data }) => {
                    this.fetchMedia();
                    this.selection.length = 0;
                    this.$toast.success("Move Successfully");
                })
                .catch(err => console.log(err));
        },
        createFolder() {
            this.Dropdown.toggle();
            let newFolder = prompt('Create new folder ...', 'New folder');
            let currentFolder = this.folderStack[this.folderStack.length - 1].id;

            if (newFolder) {
                this.request()
                    .post('/folder/create',{name:newFolder,id:currentFolder})
                    .then(({ data }) => {
                        if (data.success) {
                            this.$toast.success('Created ..');
                            this.fetchMedia();
                        } else {this.$toast.error('Something went wrong')};
                    })
                    .catch(err => this.$toast.error('Something went wrong'));
            }
        },
        showModal(media) {
            this.modalItem = media;
           this.modal.show();
        },
        modalResponse() {
            this.modal.hide();
            this.fetchMedia();
        },
        dropdown() {
            this.Dropdown.toggle();
        },
    },
    mounted() {
        this.fetchMedia();
        this.modal = new Modal(this.$refs.mediaModal.$el);
        this.fileUploadModal = new Modal(this.$refs.uploadModal.$el);
        this.Dropdown = new Dropdown(this.$refs.dropdown);
        this.modalItem = this.folderStack[0];
    },
    unmounted() {
        this.modal.hide();
        this.fileUploadModal.hide();
        
    }
}
</script>
<style lang="scss">
.media-image {
    width: 100%;
    aspect-ratio: 1/1;
    border-radius: 10px;

    &.is_selected {
        padding: 10px;
        border-style: solid;
    }
}
</style>