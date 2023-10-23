<template>
  <PageMain>
    <template v-slot:head>
      <PageHeader title="Dashboard"></PageHeader>
    </template>
    <template v-slot:content>
      <div class="row row-cols-1 row-cols-sm-3 g-4">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{posts}}</h5>
              <p class="card-text text-secondary">Totoal Posts</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ category }}</h5>
              <p class="card-text text-secondary">Total Categories</p>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{tags}}</h5>
                <p class="card-text text-secondary">Total Tags</p>
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
  },
  data() {
    return {
      posts:0,
      category:0,
      tags: 0,
      isReady:false
    }
  },
  methods: {
    fetchData() {
      return this.request()
        .get('/dash')
        .then(({ data }) => {
          this.posts = data.posts;
          this.category = data.category;
          this.tags = data.tags;
        })
        .catch(() => {
          this.$toast.error('Something Wents wrong');
        });
    }
  },
  async created() {
    await Promise.all([this.fetchData()]);
    this.isReady = true;
  },
}
</script>