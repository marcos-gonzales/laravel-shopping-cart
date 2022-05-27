<template>
    <div class="max-w-40">
        {{order}}
    </div>
</template>

<script>
import Pagination from '../../Shared/Pagination';
import {Link} from '@inertiajs/inertia-vue3';
import Button from "../../Shared/Button";
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {}
    },
    props: {
        user: Object,
        order: Array
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
    }
}
</script>
