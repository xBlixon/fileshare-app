<script setup lang="ts">
import { Button } from '@/components/ui/button';

interface Props {
    text: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Button class="mt-4 w-full">
        {{ props.text }}
    </Button>
</template>

<style scoped></style>
