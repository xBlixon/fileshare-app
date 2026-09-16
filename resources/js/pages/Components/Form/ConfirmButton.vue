<script setup lang="ts">
import type { HTMLAttributes} from 'vue';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';

defineProps<{
    defaultText: string;
    confirmText?: string;
    defaultStyle: HTMLAttributes['class'];
    confirmStyle?: HTMLAttributes['class'];
}>();

const isConfirming = ref(false);

function handleClick(event: MouseEvent) {
    if (!isConfirming.value) {
        isConfirming.value = true;
    } else {
        const target = event.target as HTMLElement;
        target.closest('form')?.requestSubmit();
    }
}
</script>

<template>
    <Button
        type="button"
        variant="outline"
        :class="isConfirming ? (confirmStyle ?? defaultStyle) : defaultStyle"
        @click.prevent="handleClick"
    >
        {{ isConfirming ? (confirmText ?? defaultText) : defaultText }}
    </Button>
</template>

<style scoped></style>
