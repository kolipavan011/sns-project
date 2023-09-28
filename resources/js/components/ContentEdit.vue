<template>
    <div class="content-edit">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <input type="email" class="form-control" placeholder="Post title">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">Slug</label>
                    <input type="email" class="form-control" placeholder="Post slug ...">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Category</label>
                    <input type="text" class="form-control"  placeholder="Add Category">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Tags</label>
                    <input type="text" class="form-control" placeholder="Add tags">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <textarea class="form-control" cols="30" rows="5" placeholder="Write description here ..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Content</label>
                    <textarea class="form-control" cols="30" rows="15" placeholder="Content here ..."></textarea>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'ContentEdit'
}
</script>