<script setup lang="ts">
import { AudioLines, Clapperboard, FileText, X } from '@lucide/vue';
import { filesize } from 'filesize';
import type { HTMLAttributes } from 'vue';
import {
    Attachment,
    AttachmentAction,
    AttachmentActions,
    AttachmentContent,
    AttachmentDescription,
    AttachmentGroup,
    AttachmentMedia,
    AttachmentTitle,
} from '@/components/ui/attachment';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const filesToUpload = defineModel<File[]>({ required: true });

function imageURL(file: File): string {
    return URL.createObjectURL(file);
}

function getFileIcon(mimeType: string) {
    if (mimeType.startsWith('video/')) {
        return Clapperboard;
    }

    if (mimeType.startsWith('audio/')) {
        return AudioLines;
    }

    return FileText;
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

function removeFile(index: number) {
    filesToUpload.value.splice(index, 1);
}
</script>

<template>
    <AttachmentGroup :class="filesToUpload.length ? props.class : ''">
        <template v-for="(file, index) in filesToUpload" :key="index">
            <Attachment class="w-64 max-[845px]:flex-1">
                <AttachmentMedia
                    v-if="file.type.startsWith('image/')"
                    variant="image"
                >
                    <img :src="imageURL(file)" :alt="file.name" />
                </AttachmentMedia>

                <AttachmentMedia v-else variant="icon">
                    <component :is="getFileIcon(file.type)" />
                </AttachmentMedia>

                <AttachmentContent>
                    <AttachmentTitle>{{ file.name }}</AttachmentTitle>
                    <AttachmentDescription>{{
                        getFileDescription(file)
                    }}</AttachmentDescription>
                </AttachmentContent>
                <AttachmentActions>
                    <AttachmentAction
                        :aria-label="`Remove ${file.name}`"
                        @click.prevent="removeFile(index)"
                    >
                        <X color="#ffffff" />
                    </AttachmentAction>
                </AttachmentActions>
            </Attachment>
        </template>
    </AttachmentGroup>
</template>

<style scoped></style>
