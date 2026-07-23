<script setup lang="ts">
import Layout from '@/pages/Templates/Layout.vue';
import FormLayout from '@/pages/Components/Form/FormLayout.vue';
import FormInput from '@/pages/Components/Form/FormInput.vue';
import { CardFooter } from '@/components/ui/card';
import Submit from '@/pages/Components/Form/Submit.vue';
import { login } from '@/actions/App/Http/Controllers/LoginController';
import FormCheckbox from '@/pages/Components/Form/FormCheckbox.vue';

const route = login();

</script>

<template>
    <Layout>
        <FormLayout
            title="Log in to your account"
            description="Enter your credentials"
            :action="route.url"
            :method="route.method"
        >
            <FormInput name="email" label="Email" type="email" />
            <FormInput name="password" label="Password" type="password" />
            <FormCheckbox name="remember_me" label="Remember me" />
            <CardFooter>
                <Submit text="Log in" />
            </CardFooter>
        </FormLayout>
    </Layout>
</template>
