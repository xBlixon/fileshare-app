<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '@/pages/Components/Navbar.vue';
import Message from '@/pages/Components/Message.vue';

const page = usePage();

const props = defineProps({
    verticalCenter: Boolean,
});
</script>

<template>
    <Head title=""></Head>
    <div class="flex min-h-screen flex-col">
        <Navbar />
        <div
            :class="
                'mx-auto flex-1 md:w-3/5' +
                (props.verticalCenter ? ' flex flex-col justify-center' : '')
            "
        >
            <div class="flex justify-center">
                <slot />
            </div>
        </div>
        <Message
            v-if="page.flash.success"
            :message="page.flash.success"
            type="success"
        />
        <Message
            v-if="page.flash.message"
            :message="page.flash.message"
            type="neutral"
        />
        <Message
            v-if="page.flash.error"
            :message="page.flash.error"
            type="error"
        />
    </div>
</template>
