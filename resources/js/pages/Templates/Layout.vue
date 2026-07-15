<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { Button } from '@/components/ui/button';
</script>

<template>
    <Head title=""> </Head>
    <Button>
        <ArrowRight />
    </Button>
    <slot />
</template>
