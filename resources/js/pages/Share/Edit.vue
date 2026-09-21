<script setup lang="ts">
import { Form, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update } from '@/actions/App/Http/Controllers/ShareController';
import { Button } from '@/components/ui/button';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Layout from '@/pages/Templates/Layout.vue';
import type { Share } from '@/types/app/Share';

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

                <Button class="mt-3 w-full py-5">Update</Button>
            </Form>
        </FormLayout>
    </Layout>
</template>

<style scoped></style>
