<script setup lang="ts">
import ShareInfo from '@/types/app/shareInfo';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import formatSmartDate from '@/functions/SmartDate';
import { File } from '@lucide/vue';
import { show } from '@/actions/App/Http/Controllers/ShareController';

const props = defineProps<{
    share: ShareInfo;
}>();
</script>

<template>
    <Card class="relative">
        <CardHeader>
            <CardTitle>
                {{ props.share.title }}
            </CardTitle>
            <CardDescription>
                {{ props.share.description }}
            </CardDescription>
        </CardHeader>
        <CardContent class="mt-auto">
            <div class="flex justify-between text-xs text-muted-foreground">
                <span>{{ formatSmartDate(share.created_at) }}</span>
                <span class="flex items-center">{{ share.files_count }} <File class="w-[1.2em] h-[1.2em]" /></span>
            </div>

        </CardContent>
        <a :href="show(share.id).url" class="absolute inset-0"></a>
    </Card>
</template>

<style scoped></style>
