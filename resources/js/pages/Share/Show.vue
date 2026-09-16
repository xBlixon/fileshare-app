<script setup lang="ts">
import { Form, usePage } from '@inertiajs/vue3';
import mime from 'mime';
import { show } from '@/actions/App/Http/Controllers/FileController';
import { destroy } from '@/actions/App/Http/Controllers/ShareController';
import {
    Attachment,
    AttachmentContent,
    AttachmentDescription,
    AttachmentGroup,
    AttachmentMedia,
    AttachmentTitle,
    AttachmentTrigger,
} from '@/components/ui/attachment';
import fileDescription from '@/functions/FileDescription';
import getFileIcon from '@/functions/GetFileIcon';
import getFileType from '@/functions/GetFileType';
import ConfirmButton from '@/pages/Components/Form/ConfirmButton.vue';
import Layout from '@/pages/Templates/Layout.vue';
import type file from '@/types/app/file';

const page = usePage<{
    share: {
        id: number;
        user_id: number;
        title: string;
        description: string;
        files: file[];
    };
}>();
</script>

<template>
    <Layout horizontal-center>
        <div>
            <h2 class="mb-2 text-2xl font-bold">
                {{ page.props.share.title }}
            </h2>
            <p>{{ page.props.share.description }}</p>
        </div>
        <div class="mx-auto w-full py-12">
            <AttachmentGroup class="flex w-full flex-wrap justify-center">
                <template v-for="file in page.props.share.files" :key="file.id">
                    <Attachment orientation="vertical">
                        <AttachmentMedia
                            v-if="
                                (
                                    mime.getType(getFileType(file.name)) ?? ''
                                ).startsWith('image/')
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
                        <AttachmentTrigger as-child>
                            <a
                                :href="show(file).url"
                                target="_blank"
                                rel="noreferrer"
                                :aria-label="`Open `"
                                class="absolute inset-0"
                            />
                        </AttachmentTrigger>
                    </Attachment>
                </template>
            </AttachmentGroup>
        </div>
        <div v-if="page.props.auth.user.id === page.props.share.user_id">
            <Form
                :method="destroy(page.props.share).method"
                :action="destroy(page.props.share).url"
            >
                <ConfirmButton
                    default-text="Delete share"
                    default-style="text-destructive"
                    confirm-text="Are you sure?"
                    confirm-style="text-destructive border-destructive!"
                />
            </Form>
        </div>
    </Layout>
</template>
