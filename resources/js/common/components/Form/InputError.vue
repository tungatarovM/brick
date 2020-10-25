<template>
  <div v-show="error.length" class="input-error">
    <p class="input-error__text text-error">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default {
  name: "InputError",
  props: {
    error: {
      type: String,
      required: true,
    }
  }
}
</script>
