<template>
    <div class="mt-8 flex">
        <button
            class="text-2xl border border-white p-4 w-3/4 mx-auto rounded-full text-black ease-in duration-200"
            :class="color"
        >
        <slot></slot>
        </button>
    </div>
</template>
<script>
export default {
  data() {
    return {

    }
  },
  props: {
    color: String,
    text: String
  }
}
</script>
