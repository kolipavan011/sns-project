<template>
    <PageMain>
        <template v-slot:head>
            <PageHeader title="Dashboard"></PageHeader>           
        </template>
        <template v-slot:content>
            <div class="page__tool mb-5">
                <div class="d-flex justify-content-end">
                  <div class="me-auto">
                    <button type="button" class="btn btn-primary text-uppercase fw-bold">Add</button>
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
            <table class="table border-top">
              <thead>
                <tr>
                  <th scope="col">Post Title</th>
                  <th scope="col">Option</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in [1,2,3,4,5,6,7,8,9,10,11,12,13]">
                  <td>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, tempora.</p>
                    <p class="text-muted">Created on 12 days ago in love, sad</p>
                  </td>
                  <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24" class="icon-cheveron-right-circle">
                        <circle cx="12" cy="12" r="10" style="fill: none" />
                        <path
                            class="fill-light-gray"
                            d="M10.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"
                        />
                    </svg>
                  </td>
                </tr>
              </tbody>
            </table>
        </template>
    </PageMain>
</template>
<script>
import PageMain from '../components/PageMain.vue';
import PageHeader from '../components/PageHeader.vue';

export default {
    name: 'dashboard',
    components: {
        PageMain,
        PageHeader
    }
}
</script>