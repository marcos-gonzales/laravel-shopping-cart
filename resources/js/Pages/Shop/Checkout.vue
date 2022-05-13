<template>
    <div class="max-w-40">
        <p v-if="error" class="text-red-800">Something went wrong fetching your items</p>
        <div>
                <div v-if="products" v-for="product in products" class="flex items-top gap-x-8 border-b border-white py-6">
                    <img :src="product.file_path" alt="{{product.name}}" style="height: 100px; width: 100px;">
                    <h3 class="text-lg text-center" v-text="product.name"></h3>
                    <!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
                    <small class="text-lg"><span class="text-yellow-400">$</span>{{product.price}}</small>
                    <div>
                        <button class="text-lg p-4 border border-white rounded-full text-black ease-in duration-200 bg-white" @click="removeItemFromCart(product)">remove from cart</button>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import Button from "../../Shared/Button";

export default {
    data() {
        return {
            products: [],
            error: false
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
        removeItemFromCart(product) {
            localStorage.removeItem(`product_${product.id}`)
        }
    },
    mounted() {
        let keys = Object.keys(localStorage);
        keys.forEach((key) => {
            try {
                this.products.push(JSON.parse(localStorage.getItem(key)));
            } catch {
                this.error = true;
            }
        })
    },
}
</script>
