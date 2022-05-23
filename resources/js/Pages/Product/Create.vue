<template>
    <div class="max-w-3xl mx-auto">
        <div class="flex text-xl">
            <h2>Upload <span class="text-yellow-200">Product</span> here</h2>
            <i class="fa-solid fa-upload ml-4"></i>
            <div class="w-2/3 flex justify-end">
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <form @submit.prevent="form.post('/product')" method="post">
            <Input
                name="name"
                v-model:textValue="form.name"
                placeholder="Product name"
                icon="fa-solid fa-pencil"
            />

            <Input
                name="description"
                v-model:textValue="form.description"
                placeholder="Product description"
                icon="fa-solid fa-file-pen"
            />

            <Input
                name="price"
                v-model:textValue="form.price"
                placeholder="Product Price"
                icon="fa-solid fa-sack-dollar"
            />

            <Input type="hidden" name="slug" v-model:textValue="form.name" />

            <div class="flex items-center space-x-2">
                <p class="uppercase">Categories:</p>
                <select
                    multiple="multiple"
                    @change="updateCategory($event)"
                    class="bg-gray-900 w-full  border border-gray-400 cursor-pointer"
                >
                    <option v-for="category in categories" :value="category.id">
                        {{ category.slug }}
                    </option>
                </select>
            </div>

            <input class="mt-8" type="file" name="file" @input="form.file_upload = $event.target.files[0]">

            <Button color="bg-blue-800 hover:bg-yellow-200">Create</Button>
        </form>
    </div>
</template>

<script>
import Input from "../../Shared/Input.vue";
import Button from "../../Shared/Button.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    setup() {
        const form = useForm({
            name: null,
            description: null,
            price: null,
            slug: null,
            category: null,
            file_upload: null
        });

        function createProduct() {
            Inertia.post("/product", form), {
              forceFormData: true
            };
        }

        function updateCategory(event) {
            form.category = event.target.value;
        }

        return {
            form,
            createProduct,
            updateCategory,
        };
    },
    components: {
        Input,
        Button,
    },
    props: {
        categories: Object,
    },
};
</script>

<style></style>
