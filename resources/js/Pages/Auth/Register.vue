<template>
    <div class="w-full md:w-1/2 mx-auto view h-100">
        <h2 class="text-4xl tracking-wider">
            Join ShopsRus where we have millions of items in inventory
        </h2>
        <p class="text-gray-500 mt-4">
            And we can ship items as fast as same day or night. Whatever you
            need we have. Seriously, check us out. sign up now &nbsp;
            <i class="fa-solid fa-hand-point-down text-white"></i>
        </p>
        <form
            @submit.prevent="form.post('/register')"
            class="border border-gray-700 my-6 p-8"
        >
            <h4 class="text-2xl text-center tracking-widest">Register Now..</h4>
            <div class="my-8">
                <i class="fa-solid fa-user-tie absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    placeholder="Elon Musk"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-envelope absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    placeholder="elon@example.org"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-location-dot absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.address"
                    type="text"
                    name="address"
                    placeholder="123 Street"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-city absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.city"
                    type="text"
                    name="city"
                    placeholder="SLC"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-flag-usa absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.state"
                    type="text"
                    name="state"
                    placeholder="Utah"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-envelope absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.zip_code"
                    type="text"
                    name="zip_code"
                    placeholder="@your zip code goes here"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-lock absolute mt-4 ml-4 text-xl"></i>
                <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    placeholder="********"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <input
                    vmodel="form.terms_of_service"
                    type="checkbox"
                    :checked="form.terms_of_service"
                    @input="form.terms_of_service = $event.target.checked"
                    name="terms-of-service"
                    placeholder="********"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                    style="max-width: 10%"
                />
                <label class="text-sm"
                    >I agree to the
                    <a href="#" class="text-blue-300 underline"
                        >terms of service</a
                    >
                    regulations listed.</label
                >
            </div>

            <div class="mt-8 flex">
                <button
                    class="text-2xl border border-white p-4 w-3/4 mx-auto rounded-full bg-blue-800 text-black hover:bg-yellow-200 ease-in duration-200"
                >
                    Sign up
                </button>
            </div>

            <div class="mt-6 flex justify-center">
                <p class="text-gray-400 text-center">
                    Already have an account?
                    <a href="/login" class="text-blue-800 underline">Login</a>
                </p>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
    },
    setup() {
        const form = useForm({
            name: null,
            email: null,
            password: null,
            terms_of_service: true,
            address: null,
            city: null,
            state: null,
            zip_code: null
        });

        function register() {
            Inertia.post("/register", form);
        }

        return {
            form,
            register,
        };
    },
};
</script>

<style lang="scss" scoped></style>
