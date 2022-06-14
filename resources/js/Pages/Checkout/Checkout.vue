<template>
    <div class="max-w-40">
        <p v-if="error" class="text-red-800">Something went wrong fetching your items</p>
        <div class="grid grid-cols-1 md:grid-cols-3 auto-rows-auto h-full">
            <div class="md:col-span-2">
                <div v-for="(productInCart, key) in productsInCart" :key="key">
                    <div v-for="(product, key) in productInCart.products" :key="key" class="gap-x-8 border border-sky-100 py-6 px-2 bg-slate-700 w-3/4 my-12 grid grid-cols-1 md:grid-cols-3 rounded">
                        <div class="flex items-center">
<!--                            <img :src="product.file_path" alt="{{product.name}}" style="height: 100px; width: 100px; word-break: keep-all" class="col-span-1 border-2 border-gray-600">-->
                             <img :src="'http://localhost:8000/storage/products/' + product.id + '/' +  product.file_path" :alt="product.name">
                        </div>
                        <div class="flex flex-col items-start">
                            <h3 class="text-lg text-center text-gray-200 font-bold capitalize" v-text="product.name"></h3>
                            <small class="text-lg text-lime-500"><span class="text-yellow-400">$</span>{{ parseInt(product.price).toFixed(2) }}</small>
                            <small class="text-gray-400">qty: {{product.pivot.quantity}}</small>
                        </div>
                        <div class="self-center mt-6 md:mt-0">
                            <button class="text-sm p-2 w-full border border-black rounded text-gray-200 ease-in duration-200 bg-sky-500 capitalize hover:bg-pink-400 hover:text-white" @click="destroy(product.pivot.product_id)">remove from cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-sky-900 col-span-1 mt-12 rounded p-2 h-1/2 mb-80 border border-sky-100">
                <div v-if="total == 0">
                    <Link class="text-blue-600 underline" href="/">Try adding some items to your cart</Link>
                </div>

                <div v-else class="mb-40">
                    <p class="text-xl">Total due
                        <span class="text-yellow-300 contrast-125 mr-2 font-bold">
                            today:
                        </span>
                        ${{total.reduce((num, a) => (num + Number(a)), 0).toFixed(2)}}
                    </p>

                    <div class="mt-4">
                        <label>Card Holder Name</label>
                        <input id="card-holder-name" type="text" class="pl-1 mb-2 text-black w-full placeholder-gray-500" placeholder="John Doe..">
                    </div>

                    <label>Card Number</label>
                    <div id="card-element">

                    </div>

                    <button class="text-sm p-2 mt-4 border border-black w-1/2 flex justify-center mx-auto rounded text-gray-200 ease-in duration-200
                        bg-sky-500 capitalize hover:bg-pink-400 hover:text-white" @click="processPayment">
                        Purchase now
                    </button>
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
import { loadStripe } from '@stripe/stripe-js';
export default {
    data() {
        return {
            stripe: {},
            cardElement: {},
            products: [],
            error: false,
            productKeys:  [],
        }
    },
    props: {
        productsInCart: Array,
        user: Object
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
        async processPayment() {
            this.paymentProcessing = true;

            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: {
                        name: this.user.name,
                        email: this.user.email,
                        address: {
                            line1: this.user.address,
                            city: this.user.city,
                            state: this.user.state,
                            postal_code: this.user.zip_code
                        }
                    }
                }
            )

            if (error) {
                this.paymentProcessing = false;
                alert(error);
            } else {
                this.user.paymentMethodId = paymentMethod.id;
                this.user.customerAmount = this.total.reduce((num, a) => (num * 100 + Number(a)), 0)
            }

            this.paymentProcessing = false;

            Inertia.post('/checkout/order', {
                'user': this.user,
                'amount': this.total.reduce((num, a) => (num * 100 + Number(a)), 0)
            });
        },
    },
    computed: {
        total(total) {
            return this.productsInCart.map((price) => {
                return price.products_sum_price;
            })
        },
    },
    async mounted() {
        this.stripe = await loadStripe('pk_test_5bMMJoXwkUHUXkxN8IbVCbtL00BxYtU3IW');

        const elements = this.stripe.elements();
        this.cardElement = elements.create('card', {
            classes: {
                base: 'bg-white p-1 text-gray-400 placeholder:gray-500'
            }
        });

        this.cardElement.mount('#card-element')
    }
}
</script>
