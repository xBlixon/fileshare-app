<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { watch } from 'vue';
import { onMounted } from 'vue';
import { defineModel, useTemplateRef } from 'vue';

const input = useTemplateRef<HTMLInputElement>('input');
const props = defineProps<{
    class?: HTMLAttributes['class'];
    name: string;
}>();

const filesToUpload = defineModel<File[]>({ required: true });

function handleDrop(e: DragEvent) {
    if (!e.dataTransfer || !input.value) {
        return;
    }

    appendFiles(e.dataTransfer.files);
}

function handleInputChange(e: Event) {
    const target = e.target as HTMLInputElement;

    if (target.files && target.files.length > 0) {
        appendFiles(target.files);
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

onMounted(async () => {
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
});

watch(filesToUpload, syncInputFiles, { deep: true });
</script>

<template>
    <label
        :for="props.name"
        @drop.prevent="handleDrop"
        @dragover.stop="handleDragOver"
        :class="
            'dark:bg-input/30 border-input shadow-xs focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-45 text-muted-foreground flex w-full min-w-0 cursor-pointer items-center justify-center rounded-md border border-dashed bg-transparent px-3 py-1 text-base outline-none transition-[color,box-shadow] md:text-sm ' +
            props.class
        "
        >Drag & Drop or click to upload

        <input
            type="file"
            hidden
            ref="input"
            :name="props.name + '[]'"
            :id="props.name"
            multiple
            accept="*/*"
            @change="handleInputChange"
        />
    </label>
</template>

<style scoped></style>
