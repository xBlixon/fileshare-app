<script setup lang="ts">
import Layout from '@/pages/Templates/Layout.vue';
import { usePage } from '@inertiajs/vue3';
import ShareInfo from '@/types/app/shareInfo';
import ShareCard from '@/pages/Components/ShareCard.vue';

const page = usePage<{
    shares: ShareInfo[]
}>();

</script>

<template>
    <Layout>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
            <template v-for="share in page.props.shares" :key="share.id">
                <ShareCard :share="share" />
            </template>
        </div>
    </Layout>
</template>

<style scoped>
div[data-slot="card"]:last-child:nth-child(odd) {
    grid-column: span 2;
}
</style>
