<script setup lang="ts">
import { AudioLines, Clapperboard, FileText, X } from '@lucide/vue';
import { filesize } from 'filesize';
import type { HTMLAttributes } from 'vue';
import { ref, useTemplateRef } from 'vue';
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

const input = useTemplateRef<HTMLInputElement>('input');
const filesToUpload = ref<File[]>([]);
const props = defineProps<{
    class?: HTMLAttributes['class'];
    attachmentGroupClass?: HTMLAttributes['class'];
}>();

function handleDrop(e: DragEvent) {
    if (!e.dataTransfer || !input.value) {
        return;
    }

    appendFiles(e.dataTransfer.files);
}

function handleInputChange(e: Event) {
    console.dir('Changed', e);
    const target = e.target as HTMLInputElement;

    if (target.files && target.files.length > 0) {
        appendFiles(target.files);
        target.value = '';
    }
}

function handleDragOver(e: DragEvent) {
    if (!e.dataTransfer) {
        return;
    }

    const fileItems = Array.from(e.dataTransfer.items).filter(
        (item) => item.kind === 'file',
    );

    if (fileItems.length === 0) {
        return;
    }

    e.preventDefault();
    e.dataTransfer.dropEffect = 'copy';
}

function appendFiles(files: FileList) {
    const fileArr = Array.from(files);
    filesToUpload.value.push(...fileArr);

    syncInputFiles();
    console.dir(filesToUpload.value);
}

function syncInputFiles() {
    if (!input.value) {
        return;
    }

    const dataTransfer = new DataTransfer();

    filesToUpload.value.forEach((file) => {
        dataTransfer.items.add(file);
    });

    input.value.files = dataTransfer.files;
}

function extension(file: File): string {
    const lastDotIndex = file.name.lastIndexOf('.');

    if (lastDotIndex === -1 || lastDotIndex === 0) {
        return '';
    }

    return file.name.slice(lastDotIndex + 1).toUpperCase();
}

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

function getFileDescription(file: File): string {
    const ext = extension(file);
    const size = filesize(file.size, { standard: 'iec' });

    return `${ext} · ${size}`;
}

// When dropping by accident anywhere on the screen besides drop zone
// Browser will not open file in the same window (quality of life).
window.addEventListener('drop', (e: DragEvent) => {
    if (
        e.dataTransfer &&
        e.dataTransfer.items[0] &&
        e.dataTransfer.items[0].kind === 'file'
    ) {
        e.preventDefault();
    }
});
window.addEventListener('dragover', (e: DragEvent) => {
    if (!e.dataTransfer) {
        return;
    }

    const fileItems = Array.from(e.dataTransfer.items).filter(
        (item) => item.kind === 'file',
    );

    if (fileItems.length === 0) {
        return;
    }

    e.preventDefault();
    e.dataTransfer.dropEffect = 'none';
});
</script>

<template>
    <label
        @drop.prevent="handleDrop"
        @dragover.stop="handleDragOver"
        :class="
            'dark:bg-input/30 border-input shadow-xs focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-45 text-muted-foreground flex w-full min-w-0 cursor-pointer items-center justify-center rounded-md border border-dashed bg-transparent px-3 py-1 text-base outline-none transition-[color,box-shadow] md:text-sm ' +
            props.class
        "
        >Drag & Drop files

        <input
            type="file"
            hidden
            ref="input"
            multiple
            accept="*/*"
            @change="handleInputChange"
        />
    </label>
    <AttachmentGroup
        :class="filesToUpload.length ? props.attachmentGroupClass : ''"
    >
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
                        @click.prevent="console.log($event)"
                    >
                        <X color="#ffffff" />
                    </AttachmentAction>
                </AttachmentActions>
            </Attachment>
        </template>
    </AttachmentGroup>
</template>

<style scoped></style>
