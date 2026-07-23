<script setup lang="ts">
import { Checkbox } from '@/components/ui/checkbox';

interface Props {
    name: string;
    label: string;
    placeholder?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <div class="flex items-center gap-3">
        <Checkbox :name="props.name" :id="props.name" />
        <Label :for="props.name">{{ props.label }}</Label>
    </div>
</template>

<style scoped></style>
