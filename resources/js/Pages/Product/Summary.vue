<template>
    <div class="max-w-40">
        <div class="grid grid-cols-3" style="grid-auto-rows: 12.5rem 1fr;">
            <div v-for="product in order" class="gap-x-8 border border-sky-100 py-6 px-2 bg-slate-700 w-3/4 my-6 flex max-h-48 rounded grid-flow-col col-span-2">
                <div>
                    <img :src="product.file_path" alt="{{product.name}}" style="height: 100px; width: 100px; word-break: keep-all" class="col-span-1 border-2 border-gray-600">
                    <small class="text-blue-500">{{product.created_at}}</small>
                </div>

                <div class="flex flex-col items-start">
                    <h3 class="text-lg text-center text-gray-200 font-bold" v-text="product.name"></h3>
                    <!--                             <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                    <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{ parseInt(product.price).toFixed(2) }}</small>
                    <small class="text-gray-400">qty: {{product.pivot.quantity}}</small>
                </div>
            </div>

            <div class="col-span-1 col-start-3 row-start-1 mt-6">
                <small class="mb-8 bg-yellow-500 flex p-2 rounded text-lg items-center"><i class="fa-solid fa-lightbulb pr-2"></i>You might be interested in</small>
                <div v-for="product in similarProducts" @click.prevent="showProduct(product)" class="bg-sky-800 my-4 border-2 border-white rounded flex cursor-pointer">
                    <div>
                        <img :src="product.file_path" alt="{{product.name}}" style="height: 100px; width: 100px; word-break: keep-all" class="col-span-1 border-2 border-gray-600">
                    </div>

                    <div class="flex flex-col items-start">
                        <h3 class="text-lg text-center text-gray-200 font-bold" v-text="product.name"></h3>
                        <!--                             <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                        <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{ parseInt(product.price).toFixed(2) }}</small>
                    </div>
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
        return {}
    },
    props: {
        user: Object,
        order: Array,
        similarProducts: Array
    },
    components: {
        Pagination,
        Link,
        Button,
    },
    methods: {
        destroy(product) {
            if (confirm("are you sure you want to remove this from your cart?")) {
                Inertia.delete(`/checkout/${product}`)
            }
        },
        showProduct(product) {
            Inertia.get(`/product/${product.id}`, {
                product: product
            });
        }
    },
}
</script>
