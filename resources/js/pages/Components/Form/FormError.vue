<script setup lang="ts">
const props = defineProps({
    text: String,
});
</script>

<template>
    <div class="mt-2 text-center text-sm text-red-500">
        {{ props.text }}
    </div>
</template>

<style scoped></style>
