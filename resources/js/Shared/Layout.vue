<template>
    <div class="bg-gray-900 w-full mb-12">
        <header class="border border-b-2-gray-800 py-4 px-1">
            <nav>
                <ul class="flex justify-end space-x-2 mx-1">
                    <Link href="/" class="text-xl hover:text-gray-400 grow">
                        <img src='/images/logo.png' alt="logo" style="width: 35px; border-radius: 20px;">
                    </Link>
                    <select class="bg-gray-900 border border-gray-400 cursor-pointer rounded">
                        <option v-for="category in categories" @click="categoriesIndex(category.id)">
                            {{category.slug}}
                        </option>
                    </select>
                    <Link href="/shop/checkout" style="padding: 0 1em;">
                        <i class="fa-solid fa-cart-shopping drop-shadow-md"></i>
                    </Link>
                    <Link v-if="!$page.props.user" href="/register" class="hover:text-gray-400">
                        Register
                    </Link>
                    <form  v-else @submit.prevent="logout">
                        <button class="hover:text-gray-400" method="post">
                            Logout <i class="fa-solid fa-heart-crack text-red-600"></i>
                        </button>
                     </form>

                    <Link v-if="!$page.props.user" href="/login" class="hover:text-gray-400">
                        Login
                    </Link>
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

export default {
    data() {
        return {
        };
    },
    components: {
        Link,
        FlashMessages,

    },
    props: {
        errors: Object,
        success: String,
        categories: Array
    },
    methods: {
        logout() {
            Inertia.post('/logout');
        },
        categoriesIndex(id) {
            Inertia.get(`/shop/category/${id}`)
        }
    }
};
</script>

<style>
body {
    color: white;
}
</style>
