<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bold">
                <h2 class="mb-0 fw-bolder page__title">{{ title }}</h2>
            </a>

            <div class="dropdown">
                <a class="nav-link" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <div style="width: 32px;height: 32px;" class="bg-primary rounded-circle">
                        <p class="text-uppercase fs-4 text-white text-center fw-bolder">p</p>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item">Pavan Koli</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item text-danger" href="#" @click="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'PageHeader',
    props: ['title'],
    methods: {
        logout() {
            console.log('logout');
        }
    },
}
</script>
