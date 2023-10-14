<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bold">
                <h2 class="mb-0 fw-bolder">{{ title }}</h2>
            </a>

            <div class="dropdown">
                <a class="nav-link" role="button" @click="toggleDropdown" id="defaultDropdown">
                    <div style="width: 32px;height: 32px;" class="bg-primary rounded-circle">
                        <p class="text-uppercase fs-4 text-white text-center fw-bolder">p</p>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" ref="dropdown" aria-labelledby="defaultDropdown">
                    <li><a class="dropdown-item">Pavan Koli</a></li>
                    <slot name="option"></slot>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" @click="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Dropdown } from "bootstrap/dist/js/bootstrap.esm.min";

export default {
    name: 'PageHeader',
    props: ['title'],
    data() {
        return {
            dropdown : null,
        }
    },
    methods: {
        logout() {
             window.location.href = '/vidmin/logout'
        },
        toggleDropdown() {
            this.dropdown.toggle();
        }
    },
    mounted() {
        this.dropdown = new Dropdown(this.$refs.dropdown,{autoClose:'outside'});
    }
}
</script>
