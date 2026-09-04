<script setup lang="ts">
import { X, FileText, Clapperboard, AudioLines } from '@lucide/vue';
import { usePage } from '@inertiajs/vue3';
import Layout from '@/pages/Templates/Layout.vue';
import { show } from '@/actions/App/Http/Controllers/FileController';
import {
    Attachment,
    AttachmentAction,
    AttachmentActions,
    AttachmentContent,
    AttachmentDescription,
    AttachmentGroup,
    AttachmentMedia,
    AttachmentTitle,
    AttachmentTrigger,
} from '@/components/ui/attachment';
import type file from '@/types/app/file';
import fileDescription from '@/functions/FileDescription';
import getFileIcon from "@/functions/GetFileIcon";
import getFileType from "@/functions/GetFileType";
import mime from "mime";

const page = usePage<{
    share: {
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
        <template>
            <div class="mx-auto w-full max-w-sm py-12">
                <AttachmentGroup class="w-full flex justify-center">
                    <template
                        v-for="file in page.props.share.files"
                        :key="file.id"
                    >
                        <Attachment orientation="vertical">
                            <AttachmentMedia
                                v-if="(mime.getType(getFileType(file.name)) ?? '' ).startsWith('image/')"
                                variant="image"
                            >
                                <img :src="show(file).url" :alt="file.name" />
                            </AttachmentMedia>

                            <AttachmentMedia v-else variant="icon">
                                <component :is="getFileIcon(file)" />
                            </AttachmentMedia>
                            <AttachmentContent>
                                <AttachmentTitle>{{
                                    file.name
                                }}</AttachmentTitle>
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
        </template>
    </Layout>
</template>
