<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { login } from '@/actions/App/Http/Controllers/LoginController';
import { CardFooter } from '@/components/ui/card';
import FormCheckbox from '@/pages/Components/Form/FormCheckbox.vue';
import FormError from '@/pages/Components/Form/FormError.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Submit from '@/pages/Components/Form/Submit.vue';
import Layout from '@/pages/Templates/Layout.vue';

const route = login();
</script>

<template>
    <Layout vertical-center>
        <FormLayout
            title="Log in to your account"
            description="Enter your credentials"
        >
            <Form
                :action="route.url"
                :method="route.method"
                #default="{ errors }"
            >
                <FormInput
                    name="email"
                    label="Email"
                    type="email"
                    placeholder="john@example.com"
                />
                <FormInput name="password" label="Password" type="password" />
                <FormCheckbox name="remember" label="Remember me" />
                <CardFooter class="mb-3">
                    <Submit text="Log in" />
                </CardFooter>
                <FormError v-if="errors.email" :text="errors.email" />
            </Form>
        </FormLayout>
    </Layout>
</template>
