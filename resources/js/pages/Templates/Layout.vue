<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import ThemeToggle from '@/pages/Components/ThemeToggle.vue';
</script>

<template>
    <Head title=""></Head>
    <div class="bg-background text-foreground">
        <Button>
            <ArrowRight />
        </Button>
        <ThemeToggle />
        <slot />
    </div>
</template>
