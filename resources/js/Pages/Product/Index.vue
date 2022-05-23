<template>
    <div class="max-w-40">
        <div class="grid mx-auto mb-8 grid-cols-1 md:grid-cols-5" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 cursor-pointer pb-3 bg-slate-700" v-for="product in products.data" @click="viewProduct(product)">
                <div class="grid">
                    <div>
                        <img :src="product.file_path" alt="{{product.name}}" class="mx-auto opacity-70 hover:opacity-100 border shadow-lg">
                    </div>
                    <div>
                        <h3 class="text-lg text-white text-center tracking-wide mb-2">{{ product.name }}</h3>
                        <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                        <p class="text-sm text-gray-300 mt-4 p-1.5">{{ product.description.substring(0,90) }} ...</p>
                        <div class="ml-2">
                            <i class="fa-solid fa-sack-dollar"></i><p class="text-lg text-green-600 m-0 p-1.5 inline-block">{{product.price}}</p>
                        </div>
                        <div class="flex mt-3 justify-evenly">
                            <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="text-black rounded shrink mx-1 p-1.5 self-center text-xs z-10 border-2 border-gray-600 capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :links="products.links" />
    </div>


</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import lodash from 'lodash';

export default {
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
        viewProduct(product) {
            Inertia.get(`/product/${product.id}`);
        },
        viewCategory(categoryId, event) {
            event.stopPropagation();
            Inertia.get(`/product/category/${categoryId}`)
        }
    },
};
</script>
