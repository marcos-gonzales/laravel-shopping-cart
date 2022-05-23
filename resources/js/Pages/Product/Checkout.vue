<template>
    <div class="max-w-40">
        <p v-if="error" class="text-red-800">Something went wrong fetching your items</p>
        <div class="grid grid-cols-1 md:grid-cols-3 auto-rows-auto h-full">
            <div class="md:col-span-2">
                <div v-for="(productInCart, key) in productsInCart" :key="key" class="gap-x-8 border border-sky-100 py-6 px-2 bg-slate-700 w-3/4 my-12 grid grid-cols-1 md:grid-cols-3 rounded">
                    <div class="flex items-center">
                       <img :src="productInCart.products[0].file_path" alt="{{productInCart.products[0].name}}" style="height: 100px; width: 100px;" class="col-span-1 border-2 border-gray-600 ">
                    </div>
                    <div class="flex flex-col items-start">
                       <h3 class="text-lg text-center text-gray-200 font-bold" v-text="productInCart.products[0].name"></h3>
                        <!-- <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name"> -->
                       <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{productInCart.products_sum_price}}</small>
                        <small class="text-gray-400">qty: {{productInCart.products.length}}</small>
                    </div>
                        <div class="self-center mt-6 md:mt-0">
                            <button class="text-sm p-2 border border-black rounded text-gray-300 ease-in duration-200 bg-sky-500 capitalize bg:accent-pink-400" @click="destroy(productInCart.products[0].pivot.order_id)">remove from cart</button>
                        </div>
                </div>
            </div>

            <div class="bg-sky-900 col-span-1 mt-12 rounded p-2 h-1/2 mb-80 border border-sky-100">
                <div v-if="total == 0">
                    <Link class="text-blue-600 underline" href="/">Try adding some items to your cart</Link>
                </div>

                <div v-else class="mb-40">
                    <p>Total due today: {{total.reduce((num, a) => (num + Number(a)), 0)}}</p>
                    <button class="text-sm p-2 border border-black rounded text-gray-300 ease-in duration-200 bg-sky-500 capitalize bg:accent-pink-400" @click="purchase">Purchase now</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link} from '@inertiajs/inertia-vue3';
import Button from "../../Shared/Button";
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {
            products: [],
            error: false,
            productKeys:  [],
        }
    },
    props: {
        productsInCart: Array,
    },
    components: {
        Pagination,
        Link,
        Button
    },
    methods: {
        destroy(product) {
            if (confirm("are you sure you want to remove this from your cart?")) {
                Inertia.delete(`/checkout/${product}`)
            }
        },
        purchase() {
            console.log('clicked')
        }
    },
    mounted() {

    },
    computed: {
        total(total) {
            return this.productsInCart.map((price) => {
                return price.products_sum_price;
            })
        }
    }
}
</script>
