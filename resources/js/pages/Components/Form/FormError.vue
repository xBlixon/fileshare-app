<script setup lang="ts">

const props = defineProps({
    text: String,
});

</script>

<template>
    <div class="text-red-500 text-sm text-center mt-2">
        {{ props.text }}
    </div>
</template>

<style scoped></style>
