<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import ShareCard from '@/pages/Components/ShareCard.vue';
import Layout from '@/pages/Templates/Layout.vue';
import type ShareInfo from '@/types/app/shareInfo';

const page = usePage<{
    shares: ShareInfo[];
}>();
</script>

<template>
    <Layout>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <template v-for="share in page.props.shares" :key="share.id">
                <ShareCard :share="share" />
            </template>
        </div>
    </Layout>
</template>

<style scoped>
div[data-slot='card']:last-child:nth-child(odd) {
    grid-column: span 2;
}
</style>
