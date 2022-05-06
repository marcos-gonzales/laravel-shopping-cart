<template>
    <div class="max-w-40">
      <div class="grid grid-cols-4 mx-auto mb-8" style="grid-gap: 1rem;">
        <div v-for="(product, index) in products.data" class="border border-gray-400 cursor-pointer hover:scale-105  h-full">
            <h3 class="text-lg text-center">{{ product.name }}</h3>
<!--            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">-->
            <img :src="product.file_path" alt="{{product.name}}">
            <p class="text-sm text-gray-500 mt-4 p-1.5">{{ product.description.substring(0,90) }} ...</p>
            <div class="flex mt-3">
                <small v-for="category in product.categories" class="rounded shrink mx-1 p-1.5" :style="randomColor()">{{category.name}}</small>
            </div>
        </div>
      </div>
        <Pagination :links="products.links" />
    </div>
</template>

<script>
import Pagination from '../../Shared/Pagination';

export default {
    data() {
        return {}

    },
    props: {
        products: Object,
    },
    components: {
        Pagination
    },
    methods: {
        randomColor() {
           return "background-color: #" + ((1<<24)*Math.random() | 0).toString(16);
        }
    },
};
</script>
