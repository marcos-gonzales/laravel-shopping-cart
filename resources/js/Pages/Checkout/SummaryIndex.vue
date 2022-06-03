<template>
    <div class="mx-auto">
        <h2 class="text-sky-300 text-2xl text-center">Order Summary</h2>
        <div class="grid grid-cols-3 gap-6 ">
            <div v-for="product in orders" class="gap-x-8 border border-sky-100 py-6 px-2 bg-slate-700 my-12 flex flex-col">
                <div class="flex justify-between" @click="summaryShow(product)">
                    <span class="text-center text-lg text-yellow-200 font-bold contrast-125">{{moment(product.created_at)}}</span>
                    <span class="text-center text-lg"><i class="fa-solid fa-sack-dollar"></i> {{product.total}}</span>
                </div>
                <div  class="grid grid-cols-1">

                <div v-for="prod in product.products" class="border-2 border-white my-2">
                    <div class="flex mt-6 space-x-2">
                        <img :src="prod.file_path" alt="{{prod.name}}" style="height: 100px; width: 100px; word-break: keep-all" class="col-span-1 border-2 border-gray-600">
                        <h3 class="text-lg text-center text-gray-200 font-bold capitalize" v-text="prod.name"></h3>
                        <!-- <img :src="'storage/prods/' + prod.id + '/' +  prod.file_path" :alt="prod.name"> -->
                        <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{ parseInt(prod.price).toFixed(2) }}</small>
                        <small class="text-sm text-gray-300">qty: {{ prod.pivot.quantity }}</small>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";
import moment from 'moment';
export default {
    props: {
        orders: Array
    },
    methods: {
        summaryShow(product) {
            Inertia.get(`/checkout/summary/${product.id}`, {
                product: product
            });
        },
        moment: function (date) {
            return moment(date).format('MM-DD-YYYY');
        },
    }
}
</script>
