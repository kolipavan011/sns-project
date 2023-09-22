<template>
    <div>
        <!-- toolbar -->
        <div class="page__tool mb-5">
            <div class="d-flex justify-content-end">
                <div class="me-auto">
                    <a type="button" class="btn btn-primary text-uppercase fw-bold me-2">Add</a>
                    <a v-if="false" type="button" class="btn btn-danger text-uppercase fw-bold">Delete</a>
                </div>
                <div class="ms-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="1">Published</option>
                        <option value="2">Draft</option>
                    </select>
                </div>
                <div class="ms-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="1">All Posts</option>
                        <option value="2">Your Posts</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- list table -->
        <table class="table border-top mb-5">
            <thead>
                <tr>
                    <th scope="col">Post Title</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]">
                    <td>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, tempora.</p>
                        <p class="text-muted">Created on 12 days ago in love, sad</p>
                    </td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24"
                            class="icon-cheveron-right-circle">
                            <circle cx="12" cy="12" r="10" style="fill: none" />
                            <path class="fill-light-gray"
                                d="M10.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z" />
                        </svg>
                    </td>
                </tr>
            </tbody>
        </table>
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
    </div>
</template>
<script>
export default {
    name: 'ContentList',
    created() {
        console.log('create content');
    }
}
</script>