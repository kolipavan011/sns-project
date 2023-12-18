<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bold">
                <h2 class="mb-0 fw-bolder">{{ title }}</h2>
            </a>

            <slot name="status"></slot>

            <div class="dropdown">
                <a class="nav-link" role="button" @click="toggleDropdown" id="defaultDropdown">
                    <div style="width: 32px;height: 32px;" class="bg-primary rounded-circle">
                        <p class="text-uppercase fs-4 text-white text-center fw-bolder">p</p>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" ref="dropdown" aria-labelledby="defaultDropdown">
                    <li><a class="dropdown-item">{{user}}</a></li>
                    <li><router-link to="/profile" class="dropdown-item">Edit Profile</router-link></li>
                    <slot name="option"></slot>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" @click="logout">Logout</a></li>
                    <li><hr class="dropdown-divider d-md-none"></li>
                    <li v-for="item in list" :key="item" class="d-md-none">
                        <router-link :to="{ name: item }" class="dropdown-item">{{ item }}</router-link>
                    </li>
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
            dropdown: null,
            user: '',
            list: ['dashboard', 'posts', 'media', 'category', 'tags', 'vidbot', 'setting']
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
    },
    created() {
        this.user = storynstatus.user.name;
    }
}
</script>
