<template>
    <div class="max-w-40 pb-6">
        <div class="grid mx-auto mb-8 grid-cols-1 pb-6" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-purple-400 bg-white border-cyan-400 cursor-pointer h-full hover:opacity-100 pb-10">
                <h3 class="text-4xl text-center mb-6 tracking-wider text-black font-bold">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto w-full opacity-70 hover:opacity-100 w-3/5">
                <p class="text-lg text-gray-500 mt-4 p-1.5 mx-8">{{ product.description }}</p>
                <div class="grid grid-cols-2 place-items-center my-4">
                        <div class="flex items-center">
                            <Link v-for="category in product.categories" :href="'/shop/category/' + category.id" class="rounded mx-1 p-1.5 self-center border border-black" :style="randomColor()">{{category.name}}</Link>
                        </div>
                        <button class="bg-black hover:bg-red-300 w-3/5 text-2xl border text-white border-white p-4 mx-auto rounded-full text-black ease-in duration-200 capitalize" @click="addProductToCart(product)" type="button" >
                            <i class="fa-solid fa-plus"></i>Add to cart
                        </button>
                        <p v-if="productAdded" v-text="'Product Added'" class="text-green-800 text-center"></p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <small class="text-sm text-gray-400">Not what you're looking for?
            <button @click="goBack" class="text-blue-600 underline">Go back</button>
        </small>
    </div>
</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import Button from "../../Shared/Button";
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {
            productAdded: false
        }
    },
    props: {
        product: Object,
    },
    components: {
        Pagination,
        Link,
        Button
    },
    methods: {
        randomColor() {
            return "background-color: #" + ((1<<24)*Math.random() | 0).toString(16);
        },
        goBack() {
            history.back()
        },
        addProductToCart(product) {
            Inertia.post(`/checkout/${product.id}`)
        },
    },
};
</script>
