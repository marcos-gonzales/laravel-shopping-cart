<template>
    <div class="max-w-40">
        <div class="grid grid-cols-1 md:grid-cols-3 mx-auto mb-8 " style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-purple-400  bg-slate-700 border-cyan-400 bg-white cursor-pointer h-full hover:opacity-100 z-0 pb-8" v-for="product in products.data" @click="show(product)">
                <h3 class="text-3xl text-center tracking-wider mb-6 text-white font-bold">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto w-full opacity-70 hover:opacity-100 shadow-lg">
                <p class="text-lg text-gray-300 mt-4 p-1.5 mx-8">{{ product.description.substring(0,300) }} ...</p>
                <div class="ml-8">
                    <i class="fa-solid fa-sack-dollar"></i><p class="text-lg text-green-600 m-0 p-1.5 inline-block">{{product.price}}</p>
                </div>
                <div class="flex mt-3 items-center z-50 justify-evenly">
                    <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="rounded mx-1 p-1.5 self-center z-10 border-2 border-black capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                </div>
            </div>
        </div>

<!--        <Pagination :links="productOthers.links" />-->
    </div>


</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {
        }

    },
    props: {
        products: Object
    },
    components: {
        Pagination,
        Link
    },
    methods: {
        randomColor() {
            return "background-color: #" + ((1<<24)*Math.random() | 0).toString(16);
        },
        show(product) {
            Inertia.get(`/product/${product.id}`)
        },
        viewCategory(categoryId, event) {
            event.stopPropagation();
            Inertia.get(`/product/category/${categoryId}`)
        }
    },
};
</script>
