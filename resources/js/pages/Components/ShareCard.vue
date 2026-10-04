<script setup lang="ts">
import { File } from '@lucide/vue';
import { show } from '@/actions/App/Http/Controllers/ShareController';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import formatSmartDate from '@/functions/FormatSmartDate';
import type ShareInfo from '@/types/app/ShareInfo';

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
            <div class="text-muted-foreground flex justify-between text-xs">
                <span>{{ formatSmartDate(share.created_at) }}</span>
                <span class="flex items-center"
                    >{{ share.files_count }} <File class="h-[1.2em] w-[1.2em]"
                /></span>
            </div>
        </CardContent>
        <a :href="show(share.id).url" class="absolute inset-0"></a>
    </Card>
</template>

<style scoped></style>
