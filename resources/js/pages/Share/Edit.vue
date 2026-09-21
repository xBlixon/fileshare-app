<script setup lang="ts">
import Layout from '@/pages/Templates/Layout.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import { Form, usePage } from '@inertiajs/vue3';
import { update } from '@/actions/App/Http/Controllers/ShareController';
import { Share } from '@/types/app/Share';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';

const page = usePage<{ share: Share }>();

const title = ref(page.props.share.title);
const description = ref(page.props.share.description);
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

                <Button class="mt-3 py-5 w-full">Update</Button>
            </Form>
        </FormLayout>
    </Layout>
</template>

<style scoped></style>
