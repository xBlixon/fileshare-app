<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { CardFooter } from '@/components/ui/card';
import FormError from '@/pages/Components/Form/FormError.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Submit from '@/pages/Components/Form/Submit.vue';
import Layout from '@/pages/Templates/Layout.vue';
import { store } from '@/actions/App/Http/Controllers/RegisterController';

const route = store();
</script>

<template>
    <Layout vertical-center>
        <FormLayout
            title="Create a new account"
            description="Your first step to sharing!"
        >
            <Form
                :action="route.url"
                :method="route.method"
                #default="{ errors }"
            >
                <FormInput
                    name="name"
                    label="Name"
                    type="text"
                    placeholder="John Doe"
                />
                <FormInput
                    name="email"
                    label="Email"
                    type="email"
                    placeholder="john@example.com"
                />
                <FormInput name="password" label="Password" type="password" />
                <FormInput
                    name="password_confirmation"
                    label="Confirm Password"
                    type="password"
                />
                <CardFooter class="mb-3">
                    <Submit text="Create a new account" />
                </CardFooter>
                <FormError v-if="errors.name" :text="errors.name" />
                <FormError v-if="errors.email" :text="errors.email" />
                <FormError v-if="errors.password" :text="errors.password" />
                <FormError
                    v-if="errors.password_confirmation"
                    :text="errors.password_confirmation"
                />
            </Form>
        </FormLayout>
    </Layout>
</template>

<style scoped></style>
