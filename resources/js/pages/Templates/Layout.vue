<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import ThemeToggle from '@/pages/Components/ThemeToggle.vue';
import Navbar from '@/pages/Components/Navbar.vue';
</script>

<template>
    <Head title=""></Head>
    <Navbar />
    <div class="w-full md:w-3/5 mx-auto">
        <div class="mx-auto w-fit">
            <Button variant="outline">
                <ArrowRight />
            </Button>
            <slot />
        </div>
    </div>
</template>
