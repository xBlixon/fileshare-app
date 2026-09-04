<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/ShareController';
import DropZone from '@/pages/Components/Form/DropZone.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Submit from '@/pages/Components/Form/Submit.vue';
import Layout from '@/pages/Templates/Layout.vue';
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
                <DropZone
                    class="mt-3"
                    attachment-group-class="mt-3 max-[845px]:justify-center flex-wrap"
                    name="files"
                />
                <div class="md:mx-10">
                    <Submit text="Share" class="h-12" />
                </div>
            </Form>
        </FormLayout>
    </Layout>
</template>
