<template>
    <div class="max-w-40">
        <div class="grid mx-auto mb-8 grid-cols-1" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 cursor-pointer h-full hover:opacity-100 z-0 pb-8 bg-white" @click="viewProduct(product, $event)">
                <h3 class="text-3xl text-center tracking-wider mb-4">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto w-full opacity-70 hover:opacity-100 w-3/5 border shadow-lg">
                <p class="text-lg text-gray-500 mt-4 p-1.5 mx-8">{{ product.description.substring(0,300) }} ...</p>
                <div class="flex mt-3 items-center justify-evenly">
                    <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="border-2 border-gray-600 rounded mx-1 w-2/5 text-2xl text-center p-4 self-center z-10 capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                </div>
            </div>
        </div>

        <div class="grid mx-auto mb-8 grid-cols-3" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 cursor-pointer h-full pb-8 bg-white" v-for="product in productThree" @click="viewProduct(product, $event)">
                <h3 class="text-lg text-center tracking-wide mb-4">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto opacity-70 hover:opacity-100 border shadow-lg">
                <p class="text-sm text-gray-500 mt-4 p-1.5">{{ product.description.substring(0,90) }} ...</p>
                <div class="flex mt-3 justify-evenly">
                    <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="border border-gray-600 rounded shrink mx-1 p-1.5 self-center z-10 capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                </div>
            </div>
        </div>

        <div class="grid mx-auto mb-8 grid-cols-5" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 cursor-pointer pb-3 bg-white" v-for="product in productOthers.data" @click="viewProduct(product, $event)">
                <h3 class="text-lg text-center tracking-wide mb-2">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto opacity-70 hover:opacity-100 border shadow-lg">
                <p class="text-sm text-gray-500 mt-4 p-1.5">{{ product.description.substring(0,90) }} ...</p>
                <div class="flex mt-3 justify-evenly">
                    <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="text-black rounded shrink mx-1 p-1.5 self-center text-xs z-10 border-2 border-gray-600 capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                </div>
            </div>
        </div>
        <Pagination :links="productOthers.links" />
    </div>


</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {
            url: window.location.href
        }
    },
    props: {
        product: Object,
        productThree: Object,
        productOthers: Object
    },
    components: {
        Pagination,
        Link
    },
    methods: {
        randomColor() {
           return "background-color: #" + ((1<<24)*Math.random() | 0).toString(16);
        },
        viewProduct(product, event) {
            Inertia.get(`/shop/${product.id}`);
        },
        viewCategory(categoryId, event) {
            event.stopPropagation();
            Inertia.get(`/shop/category/${categoryId}`)
        }
    },
};
</script>
