<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import Layout from '@/pages/Templates/Layout.vue';

const page = usePage();

const greeting = page.props.greeting;
</script>

<template>
    <Layout>
        <h1>Homepage</h1>
        <p>{{ greeting }}</p>
    </Layout>
</template>
