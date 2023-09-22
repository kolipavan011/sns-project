<template>
    <div class="app-container container-fluid">
        <div class="row" style="min-height: 100vh;">
            <aside class="app-sidebar col-sm-12 col-md-3 d-none d-sm-none d-md-block border-end">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                  <div class="container-fluid">
                    <a class="navbar-brand text-uppercase">Vidmin</a>
                  </div>
                </nav>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0" v-for="item in list" :key="item">
                        <router-link :to="{name:item}" class="text-decoration-none text-muted text-uppercase">{{item}}</router-link>
                    </li>
                </ul>
            </aside>
            <div class="app-main col-sm-12 col-md-9">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'app-container',
    data() {
        return {
            list:['dashboard','posts','media','category','tags','vidbot','users','setting']
        }
    },
}
</script>
<style>
/* .app-sidebar {
    min-height: 100vh;
    @media screen {
        @media (max-width: 768px) {
            min-height: auto;
            display: none;
         }
    }
}

.app-main {
    min-height: 100vh;
    @media screen {
        @media (max-width: 768px) {
            min-height: auto;
         }
    }
} */
</style>