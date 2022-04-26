<template>
    <div class="w-full md:w-1/2 mx-auto view h-100">
        <h2 class="text-2xl text-center tracking-widest">
            Sign in to start selling now!
            <i class="fa-solid fa-money-bill-1"></i>
        </h2>
        <form
            @submit.prevent="form.post('/login')"
            class="border border-gray-700 my-6 p-8"
        >
            <h4 class="text-center tracking-wide text-xl">
                You know you want to..
            </h4>
            <Input
                name="email"
                v-model:textValue="form.email"
                placeholder="bonitalatina@live.com"
                icon="fa-solid fa-envelope"
            />
            <Input
                name="password"
                v-model:textValue="form.password"
                placeholder="******"
                icon="fa-solid fa-lock"
                type="password"
            />
            <Button color="bg-blue-800 hover:bg-yellow-200">Login</Button>
            <div class="mt-6 flex justify-center">
                <p class="text-gray-400 text-center">
                    Don't have an account?
                    <a href="/register" class="text-blue-800 underline"
                        >Register</a
                    >
                </p>
            </div>
        </form>
    </div>
</template>

<script>
import Input from "../../Shared/Input.vue";
import Button from "../../Shared/Button.vue";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    setup() {
      const form = useForm({
        email: null,
        password: null
      })

      function login() {
        Inertia.post('/login', form);
      }

      return {
        form,
        login
        };
    },
    components: {
        Input,
        Button,
    },
};
</script>

<style lang="scss" scoped></style>
