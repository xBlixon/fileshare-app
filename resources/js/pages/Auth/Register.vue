<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/RegisterController';
import { CardFooter } from '@/components/ui/card';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import Submit from '@/pages/Components/Form/Submit.vue';
import Layout from '@/pages/Templates/Layout.vue';

const route = store();
</script>

<template>
    <Layout>
        <FormLayout
            title="Create a new account"
            description="Your first step to sharing!"
            :action="route.url"
            :method="route.method"
        >
            <FormInput name="name" label="Name" type="text" />
            <FormInput name="email" label="Email" type="email" />
            <FormInput name="password" label="Password" type="password" />
            <FormInput
                name="password_confirm"
                label="Confirm Password"
                type="password"
            />
            <CardFooter>
                <Submit text="Create a new account" />
            </CardFooter>
        </FormLayout>
    </Layout>
</template>

<style scoped></style>
