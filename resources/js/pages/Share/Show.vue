<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import Layout from '@/pages/Templates/Layout.vue';

const page = usePage();
</script>

<template>
    <Layout>
        <div class="text-center">
            <h2>{{ page.props.share.title }}</h2>
            <p>{{ page.props.share.description }}</p>
        </div>
    </Layout>
</template>
