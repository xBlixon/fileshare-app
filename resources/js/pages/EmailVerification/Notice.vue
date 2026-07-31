<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { send } from '@/actions/App/Http/Controllers/EmailVerificationController';
import Layout from '@/pages/Templates/Layout.vue';

const resend = send();
</script>

<template>
    <Layout>
        <div class="mt-10 text-center">
            <h1 class="mb-4 text-5xl">Verify your account</h1>
            <p class="mb-1">
                Go to your email and click on the verification link.
            </p>
            <p>
                <Form :action="resend.url" :method="resend.method">
                    Don't see the mail?
                    <button type="submit" class="text-indigo-500 underline cursor-pointer">Click here to resend.</button>
                </Form>
            </p>
        </div>
    </Layout>
</template>
