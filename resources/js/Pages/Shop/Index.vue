<template>
    <div class="max-w-40">
      <div class="grid grid-cols-4 mx-auto">
        <div v-for="(product, index) in products.data" class="border border-gray-400 cursor-pointer hover:scale-105 my-5 mx-2 h-full">
            <h3 class="text-lg text-center">{{ product.name }}</h3>
            <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">
            <p class="text-sm text-gray-500">{{ product.description.substr(0,30) }} ...</p>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    props: {
        products: Object,
    },
};
</script>
