<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '@/pages/Components/Navbar.vue';

const props = defineProps({
    verticalCenter: Boolean,
})

</script>

<template>
    <Head title=""></Head>
    <div class="flex min-h-screen flex-col">
        <Navbar />
        <div :class="'mx-auto flex-1 md:w-3/5' + ( props.verticalCenter ? ' flex flex-col justify-center' :  '' )">
            <div class="flex justify-center">
                <slot />
            </div>
        </div>
    </div>
</template>
