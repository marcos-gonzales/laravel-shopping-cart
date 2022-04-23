<template>
    <div class="bg-gray-900 w-full">
        <header class="border border-b-2-gray-800 py-4">
            <nav>
                <ul class="flex justify-end space-x-2 mx-1">
                    <Link href="/" class="text-xl hover:text-gray-400 grow">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </Link>
                    <Link href="/register" class="hover:text-gray-400">
                        Register
                    </Link>
                    <Link href="/login" class="hover:text-gray-400">
                        Loginjj
                    </Link>
                </ul>
            </nav>
        </header>
        <div class="container w-3/4 mx-auto" style="margin-top: 2em;">
            <slot />
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { components } from "vue";

export default {
    data() {
        return {};
    },
    components: {
        Link,
    },
};
</script>

<style>
body {
    color: white;
}
</style>
