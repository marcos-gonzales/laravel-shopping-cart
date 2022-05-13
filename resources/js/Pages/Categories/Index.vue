<template>
    <div class="max-w-40">
        <div class="grid mx-auto mb-8 grid-cols-3" style="grid-gap: 1rem;">
            <div class="border border-gray-400 cursor-pointer hover:scale-105  h-full hover:opacity-100" v-for="product in products.data" @click="show(product)">
                <h3 class="text-3xl text-center">{{ product.name }}</h3>
                <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                <img :src="product.file_path" alt="{{product.name}}" class="mx-auto w-full opacity-70 hover:opacity-100">
                <p class="text-lg text-gray-500 mt-4 p-1.5 mx-8">{{ product.description.substring(0,300) }} ...</p>
                <div class="flex mt-3 items-center z-50">
                    <Link v-for="category in product.categories" :href="'/shop/category/' + category.id" class="rounded mx-1 p-1.5 self-center" :style="randomColor()">{{category.name}}</Link>
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
            Inertia.get(`/shop/${product.id}`)
        }
    },
};
</script>
