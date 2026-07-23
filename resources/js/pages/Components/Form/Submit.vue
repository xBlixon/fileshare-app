<script setup lang="ts">
import { Button } from '@/components/ui/button';

interface Props {
    text: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Button class="w-full mt-4">
        {{ props.text }}
    </Button>
</template>

<style scoped></style>
