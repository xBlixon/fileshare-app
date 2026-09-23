<script setup lang="ts">
import { X } from '@lucide/vue';
import { filesize } from 'filesize';
import mime from 'mime';
import {
    Attachment,
    AttachmentAction,
    AttachmentActions,
    AttachmentContent,
    AttachmentDescription,
    AttachmentMedia,
    AttachmentTitle,
} from '@/components/ui/attachment';
import getFileIcon from '@/functions/GetFileIcon';
import getFileType from '@/functions/GetFileType';

defineProps<{
    file: File;
    enableRemove?: boolean;
}>();

const emit = defineEmits<{
    delete: [file: File];
}>();

function imageURL(file: File): string {
    return URL.createObjectURL(file);
}

function extension(file: File): string {
    const lastDotIndex = file.name.lastIndexOf('.');

    if (lastDotIndex === -1 || lastDotIndex === 0) {
        return '';
    }

    return file.name.slice(lastDotIndex + 1).toUpperCase();
}

function getFileDescription(file: File): string {
    const ext = extension(file);
    const size = filesize(file.size, { standard: 'iec' });

    return `${ext} · ${size}`;
}
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
            <img :src="imageURL(file)" :alt="file.name" />
        </AttachmentMedia>

        <AttachmentMedia v-else variant="icon">
            <component :is="getFileIcon(file)" />
        </AttachmentMedia>
        <AttachmentContent>
            <AttachmentTitle>{{ file.name }}</AttachmentTitle>
            <AttachmentDescription>{{
                getFileDescription(file)
            }}</AttachmentDescription>
        </AttachmentContent>
        <AttachmentActions v-if="enableRemove">
            <AttachmentAction @click.prevent="emit('delete', file)">
                <X color="#ffffff" />
            </AttachmentAction>
        </AttachmentActions>
    </Attachment>
</template>

<style scoped></style>
