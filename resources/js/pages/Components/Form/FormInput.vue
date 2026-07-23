<script setup lang="ts">
import { Input } from '@/components/ui/input';

interface Props {
    name: string;
    label: string;
    type: string;
    placeholder?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Label :for="props.name">{{ props.label }}</Label>
    <Input
        :name="props.name"
        :type="props.type"
        :placeholder="props.placeholder"
        :id="props.name"
        class="mb-2"
    />
</template>

<style scoped></style>
