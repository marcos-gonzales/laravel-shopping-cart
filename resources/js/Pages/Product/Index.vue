<template>
    <div class="max-w-40">
        hi{{hi}}
        hey {{hey}}
        <div class="grid mx-auto mb-8 grid-cols-1 md:grid-cols-5" style="grid-gap: 1rem;">
            <div class="border-2 border-t-purple-500 border-r-cyan-400 border-b-purple-400 border-l-cyan-400 cursor-pointer pb-3 bg-slate-700" v-for="product in products.data" @click="viewProduct(product)">
                <div class="grid">
                    <div>
                        <img :src="'storage/products/' + product.id + '/' +  product.file_path" :alt="product.name" class="mx-auto opacity-70 hover:opacity-100 border shadow-lg">
<!--                    <img :src="product.file_path" alt="{{product.name}}" class="mx-auto opacity-70 hover:opacity-100 border shadow-lg" style="width: ">-->
                    </div>
                    <div>
                        <h3 class="text-lg text-white text-center tracking-wide mb-2">{{ product.name }}</h3>
                        <p class="text-sm text-gray-300 mt-4 p-1.5">{{ product.description.substring(0,50) }}...</p>
                        <div class="ml-2">
                            <i class="fa-solid fa-sack-dollar"></i><p class="text-lg text-green-600 m-0 p-1.5 inline-block">{{parseInt(product.price).toFixed(2)}}</p>
                        </div>
                        <div class="flex mt-3 justify-evenly">
                            <Link v-for="category in product.categories" @click="viewCategory(category.id, $event)" :class="category.slug" class="rounded shrink mx-1 p-1.5 self-center basis-1/4 text-center text-xs z-10 border-2 border-gray-600 capitalize text-white">{{category.name}}</Link>
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

export default {
    data() {
        return {
            books: null,
            men: null

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
        viewProduct(product) {
            Inertia.get(`/product/${product.id}`);
        },
        viewCategory(categoryId, event) {
            event.stopPropagation();
            Inertia.get(`/product/category/${categoryId}`)
        }
    },
    computed: {
        hey() {
            switch(this.arr) {
                case 0:
                    console.log('hi')
                    return 'its cero';
                case 1:
                    console.log('ehy')
                    return 'its uno';
                case 2:
                    return 'its dos';
            }
        },
        hi() {
            this.products.data.forEach((category) => {
               switch(category.categories[0].name) {
                    case 'books':
                        this.books =  'bg-cyan-300';
                        break;
                    case 'men':
                        this.men = 'bg-gray-300';
                        break;
                    case 'women':
                        return 'bg-cyan-300'
                    // return this.color = 'bg-cyan-300';
                    // break;
                    case 'electronics':
                        return 'bg-green-300';
                    // return this.color = 'bg-green-300';
                    // break;
                    case 'kids':
                        return 'bg-blue-300';
                    // break;
                    case 'baby':
                        return 'bg-pink-300';
                    // break;
                    case 'beauty and personal care':
                        return 'bg-zinc-300';
                    case 'pet':
                        return 'bg-amber-300';
                    case 'home improvement':
                        return 'bg-red-300';
                    case 'clothing':
                        return 'bg-lime-300';
                    case 'kitchen and bath':
                        return 'bg-emerald-300';
                    case 'computers':
                        return 'bg-teal-300';
                    case 'miscellaneous':
                        return 'bg-indigo-300';
                }
            })
        }
    }
};
</script>
<style>
.books {
    background-color:  rgb(14 116 144);
}
.men {
    background-color:  rgb(55 65 81);
}

.women {
    background-color: rgb(109 40 217);
}

.electronics {
    background-color:   rgb(4 120 87);
}

.kids {
    background-color:  rgb(30 64 175);
}

.baby {
    background-color: rgb(159 18 57);
}

.beauty-and-personal-care {
    background-color: rgb(134 25 143);
}

.pet {
    background-color: rgb(146 64 14);
}

.home-improvement {
    background-color: rgb(7 89 133);
}

.clothing {
    background-color: rgb(63 98 18);
}

.kitchen-and-bath {
    background-color: rgb(6 95 70);
}

.computers {
    background-color: rgb(17 94 89);
}

.miscellaneous {
    background-color: rgb(55 48 163);
}
</style>
