<template>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">{{video.name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <video :src="video.path" class="preview" controls :poster="video.preview" preload="none"></video>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="detachVideo">Detach</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  name: 'VideoModal',
  props: {
    video: {
      type: Object,
      require:true
    }
  },
  methods: {
    detachVideo() {
      this.$emit('response');
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