<template>
  <PageMain>
    <template v-slot:head>
      <PageHeader title="Dashboard"></PageHeader>
    </template>
    <template v-slot:content>
      <div class="row row-cols-1 row-cols-sm-2 g-4">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
      </div>
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