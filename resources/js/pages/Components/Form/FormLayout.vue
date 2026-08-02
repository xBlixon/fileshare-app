<script setup lang="ts">
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
    wide: Boolean,
});

const widthStyle = props.wide ? 'max-w-6xl' : 'max-w-sm';

</script>

<template>
    <Card :class="'w-full ' + widthStyle">
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
