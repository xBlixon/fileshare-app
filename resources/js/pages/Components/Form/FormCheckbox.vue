<script setup lang="ts">
import { Checkbox } from '@/components/ui/checkbox';

interface Props {
    name: string;
    label: string;
    placeholder?: string;
}

const model = defineModel<boolean>();
const props = defineProps<Props>();
</script>

<template>
    <div class="flex items-center gap-3">
        <Checkbox :name="props.name" :id="props.name" :value="model ? '1' : '0'" />
        <Label :for="props.name">{{ props.label }}</Label>
    </div>
</template>

<style scoped></style>
