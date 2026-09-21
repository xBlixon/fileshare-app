<script setup lang="ts">
import { Form, usePage } from '@inertiajs/vue3';
import mime from 'mime';
import { show } from '@/actions/App/Http/Controllers/FileController';
import { destroy, edit } from '@/actions/App/Http/Controllers/ShareController';
import {
    Attachment,
    AttachmentContent,
    AttachmentDescription,
    AttachmentGroup,
    AttachmentMedia,
    AttachmentTitle,
    AttachmentTrigger,
} from '@/components/ui/attachment';
import { Button } from '@/components/ui/button';
import fileDescription from '@/functions/FileDescription';
import getFileIcon from '@/functions/GetFileIcon';
import getFileType from '@/functions/GetFileType';
import ConfirmButton from '@/pages/Components/Form/ConfirmButton.vue';
import Layout from '@/pages/Templates/Layout.vue';
import type { Share } from '@/types/app/Share';

const page = usePage<{ share: Share }>();
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
        <div
            class="flex gap-2"
            v-if="page.props.auth.user.id === page.props.share.user_id"
        >
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
            <a :href="edit(page.props.share).url"
                ><Button variant="outline" class="text-chart-2">Edit</Button></a
            >
        </div>
    </Layout>
</template>
