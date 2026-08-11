<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { Button } from '@/components/ui/button';

interface Props {
    text: string;
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();
</script>

<template>
    <Button :class="'mt-4 w-full ' + props.class" type="submit">
        {{ props.text }}
    </Button>
</template>

<style scoped></style>
