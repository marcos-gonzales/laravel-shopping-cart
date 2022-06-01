<template>
    <div class="mx-auto">
        <h2 class="text-orange-400 text-2xl text-center">Order Summary</h2>
        <div class="grid grid-cols-3">
            <div v-for="product in orders" class="gap-x-8 border border-sky-100 py-6 px-2 bg-slate-700 w-3/4 my-12 flex flex-col rounded">
                <span class="text-center text-lg">Total: {{product.total}}</span>
                <div v-for="prod in product.products" class="flex flex-col">
                    <div class="flex mt-6 space-x-2">
                        <img :src="prod.file_path" alt="{{prod.name}}" style="height: 100px; width: 100px; word-break: keep-all" class="col-span-1 border-2 border-gray-600">
                        <h3 class="text-lg text-center text-gray-200 font-bold" v-text="prod.name"></h3>
                        <!-- <img :src="'storage/prods/' + prod.id + '/' +  prod.file_path" :alt="prod.name"> -->
                        <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{ parseInt(prod.price).toFixed(2) }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        orders: Array
    },
    computed: {

    }
}
</script>
