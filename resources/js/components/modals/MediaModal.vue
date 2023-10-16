<template>
    <div class="modal modal-lg modal-md modal-dialog-scrollable" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ item.name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <template v-if="item.type == 'folder' || item.type == 'image'">
                          <img :src="item.type == 'folder' ? '/storage/next-folder.png' : item.path" class="preview">
                        </template>
                        <template v-else>
                          <video :src="item.path" class="preview" controls :poster="item.preview" preload="none"></video>
                        </template>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="deleteItem">Delete</button>
              <button type="button" class="btn btn-primary" @click="rename">Rename</button>
              <button type="button" class="btn btn-info" @click="copyUrl">Copy Url</button>
              <button type="button" class="btn btn-success" v-if="item.type == 'video'">Capture</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import copy from 'copy-to-clipboard';

export default {
  name: 'MediaModal',
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  methods: {
    rename() {
      let name = prompt('Lets give a name', this.item.name);
      let type = this.item.type == 'folder' ? 'folder' : 'media';
      if (name)
        this.request()
          .post(type+'/'+ this.item.id, { name: name })
          .then(resp => {
            this.$toast.success('Changed SuccessFully');
            this.$emit('modalResponse');
          })
          .catch(err => this.$toast.error('Something wents wrong'));
    },
    deleteItem() {
      let type = this.item.type == 'folder' ? 'folder' : 'media';
      this.request()
        .delete(type + '/' + this.item.id)
        .then(resp => {
          this.$emit('modalResponse');
          this.$toast.success('Delete SuccessFully');
        })
        .catch(err => this.$toast.error('Something wents wrong'));
    },
    copyUrl() {
      if (copy(this.item.path)) this.$toast.success('Url Copied');
    }
  },
}
</script>
<style>
.preview {
    width: 100%;
    height: 350px;
    object-fit: contain;
}
</style>