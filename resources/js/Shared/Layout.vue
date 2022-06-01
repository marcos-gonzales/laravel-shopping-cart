<template>
    <div class="bg-gray-900 w-full mb-12">
        <div @click="toggleNav">
            <i class="fa-solid fa-bars md:hidden text-3xl ml-1"></i>
        </div>

        <div v-if="showNav">
            <header class="border-b-2-gray-800 py-4 px-1">
                <nav>
                    <ul class="flex flex-col justify-end space-x-2 mx-1">
                        <div class="grid grid-cols-2 justify-center">
                            <Link href="/" class="text-xl hover:text-gray-400 grow">
                                <img src='/images/logo.png' alt="logo" style="width: 35px; border-radius: 20px;">
                            </Link>

                            <Link v-if="$page.props.user" href="/checkout/order" style="padding: 0 1em;">
                                <i class="fa-solid fa-cart-shopping drop-shadow-md"></i>
                            </Link>
                        </div>

                        <div class="grid grid-cols-2 justify-center">
                            <Link v-if="!$page.props.user" href="/login" class="hover:text-gray-400">
                                Login
                            </Link>

                            <Link v-if="!$page.props.user" href="/register" class="hover:text-gray-400 m-0" style="margin: 0;">
                                Register
                            </Link>

                            <form  v-else @submit.prevent="logout">
                                <button class="hover:text-gray-400" method="post">
                                    Logout <i class="fa-solid fa-heart-crack text-red-600"></i>
                                </button>
                            </form>
                        </div>

                        <div class="grid grid-cols-2 justify-center">
                            <form @keyup="search" class="grow text-gray-500" style="margin-left: 0; margin-right: 0;">
                                <input  class="rounded w-3/4" type="search" placeholder="search product.." v-model="query">
                            </form>

                            <select class="bg-gray-900 border border-gray-400 cursor-pointer rounded w-1/2" style="margin: 0;">
                                <option v-for="category in categories" @click="categoriesIndex(category.id)">
                                    {{category.slug}}
                                </option>
                            </select>
                        </div>
                    </ul>
                </nav>
            </header>
        </div>

        <header class="hidden md:block md:border md:border-b-2-gray-800 md:py-4 md:px-1">
            <nav>
                <ul class="flex justify-end space-x-2 mx-1">
                    <Link href="/" class="text-xl hover:text-gray-400 grow">
                        <img src='/images/logo.png' alt="logo" style="width: 35px; border-radius: 20px;">
                    </Link>

                    <form @keyup="search" class="grow text-gray-500">
                        <input  class="rounded p-2" type="search" placeholder="search product.." v-model="query">
                    </form>

                    <select class="bg-gray-900 border border-gray-400 cursor-pointer rounded">
                        <option v-for="category in categories" @click="categoriesIndex(category.id)">
                            {{category.slug}}
                        </option>
                    </select>

                    <div v-if="$page.props.user" class="flex items-center">
                        <Link href="/checkout/order" style="padding: 0 1em;">
                            <i class="fa-solid fa-cart-shopping drop-shadow-md text-xl"> </i>
                        </Link>
                        <div class="absolute bg-green-500 rounded-full text-center ml-8 mb-5" style="width: 25px;">
                            <span class="">{{productsInCartCount >= 1 ? productsInCartCount : ''}}</span>
                        </div>
                    </div>


                    <Link v-if="!$page.props.user" href="/login" class="hover:text-gray-400 flex items-center">
                        Login
                    </Link>

                    <Link v-if="$page.props.user" href="/checkout/summary" class="hover:text-gray-400 flex items-center">My Orders</Link>

                    <form  v-if="$page.props.user" @submit.prevent="logout" class="items-center flex">
                        <button class="hover:text-gray-400" method="post">
                            Logout <i class="fa-solid fa-heart-crack text-red-600"></i>
                        </button>
                     </form>

                </ul>
            </nav>
        </header>
        <div class="container w-3/4 mx-auto" style="margin-top: 2em;">
        <FlashMessages :success="success" :errors="errors"/>
            <slot />
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import FlashMessages from './FlashMessages';
import debounce from 'lodash/debounce';

export default {
    data() {
        return {
            query: '',
            showNav: false,
            addPaymentStatus: 0,
            addPaymentStatusError: '',
        };
    },
    components: {
        Link,
        FlashMessages,

    },
    props: {
        errors: Object,
        success: String,
        categories: Array,
        productsInCartCount: Number
    },
    methods: {
        logout() {
            Inertia.post('/logout');
        },
        categoriesIndex(id) {
            Inertia.get(`/product/category/${id}`)
        },
        search: debounce(function() {
            Inertia.get(`/product`, {
                'query': this.query,
            })
        }, 300),
        toggleNav() {
            this.showNav = !this.showNav;
        },
    },
    created() {
        console.log(this.productsInCart);
    }
};
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
body {
    color: white;
    font-family: 'Noto Sans', sans-serif;
}
</style>
