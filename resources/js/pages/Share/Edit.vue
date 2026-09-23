<script setup lang="ts">
import { Form, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update } from '@/actions/App/Http/Controllers/ShareController';
import { AttachmentGroup } from '@/components/ui/attachment';
import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import FileCard from '@/pages/Components/FileCard.vue';
import FileInfoCard from '@/pages/Components/FileInfoCard.vue';
import DropZone from '@/pages/Components/Form/DropZone.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Layout from '@/pages/Templates/Layout.vue';
import type FileInfo from '@/types/app/FileInfo';
import type { Share } from '@/types/app/Share';

const page = usePage<{ share: Share }>();

const title = ref(page.props.share.title);
const description = ref(page.props.share.description);

const uploadedFiles = ref(page.props.share.files);
const filesToRemove = ref<FileInfo[]>([]);

const filesToUpload = ref<File[]>([]);

function handleUploadedFileRemoval(file: FileInfo): void {
    const index = filesToRemove.value.indexOf(file);

    if (index !== -1) {
        filesToRemove.value.splice(index, 1);
    } else {
        if (
            uploadedFiles.value.length - 1 === filesToRemove.value.length &&
            filesToUpload.value.length === 0
        ) {
            // Prevent a share from having no files
            return;
        }

        filesToRemove.value.push(file);
    }
}

function handleFileToUploadRemoval(file: File): void {
    if (
        filesToRemove.value.length === uploadedFiles.value.length &&
        filesToUpload.value.length === 1
    ) {
        // Prevent removing file from upload list if is the ONLY remaining file.
        return;
    }

    const index = filesToUpload.value.indexOf(file);
    filesToUpload.value.splice(index, 1);
}
</script>

<template>
    <Layout horizontal-center>
        <FormLayout
            title="Edit your share"
            description="Change title and description, add files, remove files, whatever you want!"
            wide
        >
            <Form
                :action="update(page.props.share).url"
                :method="update(page.props.share).method"
                enctype="multipart/form-data"
            >
                <FormInput
                    name="title"
                    label="Your title"
                    type="text"
                    v-model="title"
                />
                <FormInput
                    name="description"
                    label="Your description"
                    type="text"
                    v-model="description"
                />

                <Label>Add/Remove files</Label>
                <Card>
                    <AttachmentGroup
                        class="flex w-full flex-wrap justify-center"
                    >
                        <template v-for="file in uploadedFiles" :key="file.id">
                            <FileInfoCard
                                :file="file"
                                enable-remove
                                @delete="handleUploadedFileRemoval"
                                :to-be-removed="filesToRemove.includes(file)"
                            />
                        </template>

                        <template v-for="file in filesToUpload" :key="file.id">
                            <FileCard
                                :file="file"
                                enable-remove
                                @delete="handleFileToUploadRemoval"
                            />
                        </template>
                    </AttachmentGroup>
                </Card>
                <input
                    type="hidden"
                    name="filesToRemove[]"
                    v-for="file in filesToRemove"
                    :value="file.id"
                    :key="file.id"
                />
                <DropZone
                    name="newFiles"
                    v-model="filesToUpload"
                    class="mt-3"
                />
                <Button class="mt-3 w-full py-5">Update</Button>
            </Form>
        </FormLayout>
    </Layout>
</template>

<style scoped></style>
