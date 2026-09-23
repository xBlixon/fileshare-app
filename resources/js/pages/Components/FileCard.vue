<script setup lang="ts">
import { X } from '@lucide/vue';
import mime from 'mime';
import { show } from '@/actions/App/Http/Controllers/FileController';
import {
    Attachment,
    AttachmentAction,
    AttachmentActions,
    AttachmentContent,
    AttachmentDescription,
    AttachmentMedia,
    AttachmentTitle,
    AttachmentTrigger,
} from '@/components/ui/attachment';
import fileDescription from '@/functions/FileDescription';
import getFileIcon from '@/functions/GetFileIcon';
import getFileType from '@/functions/GetFileType';
import type FileInfo from '@/types/app/FileInfo';

defineProps<{
    file: FileInfo;
    enableRemove?: boolean;
    toBeRemoved?: boolean;
}>();

const emit = defineEmits<{
    delete: [file: FileInfo];
}>();
</script>

<template>
    <Attachment orientation="vertical" class="overflow-hidden">
        <AttachmentMedia
            v-if="
                (mime.getType(getFileType(file.name)) ?? '').startsWith(
                    'image/',
                )
            "
            variant="image"
        >
            <img :src="show(file).url" :alt="file.name" />
        </AttachmentMedia>

        <AttachmentMedia v-else variant="icon">
            <component :is="getFileIcon(file)" />
        </AttachmentMedia>
        <AttachmentContent>
            <AttachmentTitle>{{ file.name }}</AttachmentTitle>
            <AttachmentDescription>{{
                fileDescription(file)
            }}</AttachmentDescription>
        </AttachmentContent>
        <AttachmentActions v-if="enableRemove">
            <AttachmentAction @click.prevent="emit('delete', file)">
                <X color="#ffffff" />
            </AttachmentAction>
        </AttachmentActions>
        <AttachmentTrigger as-child>
            <a
                :href="show(file).url"
                target="_blank"
                rel="noreferrer"
                :aria-label="`Open `"
                class="absolute inset-0"
            />
        </AttachmentTrigger>
        <div v-if="toBeRemoved" class="absolute inset-0 bg-red-500/15"></div>
    </Attachment>
</template>

<style scoped></style>
