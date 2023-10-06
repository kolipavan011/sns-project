<template>
    <div class="modal modal-lg modal-md modal-dialog-scrollable" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <img src="/storage/next-folder.png" class="preview">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger">Delete</button>
              <button type="button" class="btn btn-primary">Copy path</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
    name:'MediaModal',
}
</script>
<style>
.preview {
    width: 100%;
    height: 300px;
    object-fit: contain;
}
</style>