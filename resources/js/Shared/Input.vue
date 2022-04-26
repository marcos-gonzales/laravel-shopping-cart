<template>
    <div class="my-8">
        <i v-if="icon" class="absolute mt-4 ml-4 text-xl" :class="[icon]"></i>
        <input
            :value="textValue"
            @input="$emit('update:textValue', $event.target.value)"
            :type="type ? type : 'text'"
            :name="name"
            :placeholder="placeholder"
            class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
        />
    </div>
</template>
<script>
export default {
  props: {
    icon: String,
    textValue: String,
    placeholder: String,
    name: String,
    type: String
  },
  emits: ["update:textValue"]
}
</script>
