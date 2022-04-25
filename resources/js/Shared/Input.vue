<template>
<div class="my-8">
  <i v-if="icon" class="absolute mt-4 ml-4 text-xl" :class="[icon]"></i>
    <input
        :v-model="model"
        type="text"
        :name="name"
        :placeholder="placeholder"
        class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
    />
</div>
</template>
<script>
export default {
  data() {
    return {

    }
  },
  props: {
    icon: String,
    model: String,
    placeholder: String,
    name: String
  }
}
</script>
