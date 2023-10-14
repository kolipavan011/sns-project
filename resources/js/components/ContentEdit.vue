<template>
    <div class="content-edit">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label class="form-label">Title</label>
                    <input type="email" class="form-control" placeholder="Post title">
                </div>
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
                    <label for="exampleInputPassword1" class="form-label">Feature Image</label>
                    <input type="text" class="form-control" placeholder="Add Feature Image Url">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Content</label>
                    <vue-editor v-model="content" style="height: 300px;" placeholder="Write Something ..." :editorToolbar="customToolbar"></vue-editor>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { VueEditor } from "vue3-editor";


export default {
    name: 'ContentEdit',
    components: {
        VueEditor
    },
    data() {
        return {
            content: "",
            customToolbar: [
                [{header: [false, 2, 3, 4, 5, 6] }],
                ["bold", "italic","link"],
                [{ list: "ordered" }],
            ],
            post: {
                id: null,
                slug: null,
                category: [],
                tags: [],
                feature_image: null,
                body: null,
                meta: [
                    
                ]
            }
        }
    },
}
</script>