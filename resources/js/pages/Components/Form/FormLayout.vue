<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

interface Props {
    title: string;
    description: string;
    action: string;
    method?: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE' | 'get' | 'post' | 'put' | 'patch' | 'delete' ;
}

const props = withDefaults(defineProps<Props>(), {
    method: 'GET',
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
            <Form :action="props.action" :method="props.method">
                <slot />
            </Form>
        </CardContent>
    </Card>
</template>

<style scoped></style>
