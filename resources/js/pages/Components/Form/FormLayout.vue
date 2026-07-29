<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

const props = defineProps({
    title: String,
    description: String,
});
</script>

<template>
    <Card class="w-full max-w-sm">
        <CardHeader class="text-center">
            <CardTitle>
                {{ props.title }}
            </CardTitle>
            <CardDescription>
                {{ props.description }}
            </CardDescription>
        </CardHeader>
        <CardContent>
            <slot />
        </CardContent>
    </Card>
</template>

<style scoped></style>
