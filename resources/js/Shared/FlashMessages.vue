<template>
    <div
        v-if="$page.props.success"
        v-text="$page.props.success"
        class="text-green-600 bg-white p-4 mb-8"
    ></div>
    <div
        v-if="$page.props.error"
        v-text="$page.props.error"
        class="text-red-600"
    ></div>
    <div v-if="errors">
        <ul>
            <li
                v-for="(error, index) in errors"
                :key="index"
                v-text="error"
                class="text-red-600"
            ></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        success: String,
        errors: Object,
        error: String
    },
};
</script>
