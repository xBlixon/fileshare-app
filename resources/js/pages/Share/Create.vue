<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';
import { store } from '@/actions/App/Http/Controllers/ShareController';
import DropZone from '@/pages/Components/Form/DropZone.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import HorizontalFileUploadList from '@/pages/Components/Form/HorizontalFileUploadList.vue';
import Submit from '@/pages/Components/Form/Submit.vue';
import Layout from '@/pages/Templates/Layout.vue';

const filesToUpload = ref<File[]>([]);
</script>

<template>
    <Layout horizontal-center>
        <FormLayout
            title="Share new files"
            description="Upload all files you want to share."
            wide
        >
            <Form
                :action="store().url"
                :method="store().method"
                enctype="multipart/form-data"
            >
                <FormInput
                    name="title"
                    label="Title"
                    type="text"
                    placeholder="My cool files."
                />
                <FormInput
                    name="description"
                    label="Description"
                    type="textarea"
                    placeholder="Let the light shine on these files!"
                />
                <DropZone class="mt-3" name="files" v-model="filesToUpload" />
                <HorizontalFileUploadList
                    class="mt-3 flex-wrap max-[845px]:justify-center"
                    v-model="filesToUpload"
                />
                <div class="md:mx-10">
                    <Submit text="Share" class="h-12" />
                </div>
            </Form>
        </FormLayout>
    </Layout>
</template>
