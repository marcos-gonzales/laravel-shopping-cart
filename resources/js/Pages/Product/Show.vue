<template>
    <div class="max-w-40 pb-6">
        <div class="grid mx-auto mb-8 grid-cols-1" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 h-full hover:opacity-100 z-0 py-4 bg-slate-700">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="my-4">
                        <img :src="product.file_path" alt="{{product.name}}" class="mx-auto w-full opacity-70 hover:opacity-100 ml-0 md:ml-4 w-3/4 border shadow-lg">
                    </div>
                    <div>
                        <h3 class="text-3xl text-center tracking-wider mb-4 text-white">{{ product.name }}</h3>
                        <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                        <p class="text-sm md:text-lg text-gray-300 mt-4 p-1.5 mx-8">{{ product.description.substring(0,300) }} ...</p>
                        <div class="ml-8">
                            <i class="fa-solid fa-sack-dollar"></i><p class="text-lg text-green-600 m-0 p-1.5 inline-block">{{parseInt(product.price).toFixed(2)}}</p>
                        </div>
                        <div class="flex flex-col md:flex-row mt-10 items-center justify-evenly">
                            <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" class="border-2 border-gray-600 rounded mx-1 w-full md:w-2/5 text-2xl text-center p-4 self-center z-10 capitalize text-black" :style="randomColor()">{{category.name}}</Link>
                        </div>
                        <div class="flex justify-center">
                            <button class="border border-white p-4 w-1/2 bg-sky-800 text-gray-300 hover:bg-sky-600  hover:text-white rounded-full text-black ease-in duration-200 mt-8 ml-16" @click="addProductToCart(product)">Add To Cart</button>
                        </div>
                    </div>
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
            productAdded: false,
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
            if (this.user) {
                Inertia.get('/login');
            }
            Inertia.post(`/checkout/${product.id}`)
        },
        viewCategory(categoryId, event) {
            event.stopPropagation();
            Inertia.get(`/product/category/${categoryId}`)
        }
    },
    computed: {
        user() {
            return this.$page.props.user
        }
    }
};
</script>
