<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import Navbar from '@/pages/Components/Navbar.vue';
</script>

<template>
    <Head title=""></Head>
    <Navbar />
    <div class="mx-auto w-full md:w-3/5">
        <div class="flex justify-center">
            <slot />
        </div>
    </div>
</template>
