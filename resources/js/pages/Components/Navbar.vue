<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { FileUp } from '@lucide/vue';
import { computed } from 'vue';
import { index as login } from '@/actions/App/Http/Controllers/LoginController';
import { logout } from '@/actions/App/Http/Controllers/LogoutController';
import { index as register } from '@/actions/App/Http/Controllers/RegisterController';
import { create } from '@/actions/App/Http/Controllers/ShareController';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
    navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu';
import ThemeToggle from '@/pages/Components/ThemeToggle.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

function highlightAuthentication() {
    const authSection = document.getElementById('auth-section');

    authSection?.classList.add('animate-highlight');

    setTimeout(() => {
        authSection?.classList.remove('animate-highlight');
    }, 2000);
}

function sendLogout() {
    const form = useForm();
    const route = logout();
    form.submit(route.method, route.url);
}
</script>

<template>
    <div class="mb-6 flex h-14 w-full justify-between border-b px-2">
        <NavigationMenu class="py-2">
            <NavigationMenuList>
                <NavigationMenuItem>
                    <NavigationMenuLink
                        as-child
                        :class="[
                            navigationMenuTriggerStyle(),
                            'flex-row gap-2',
                        ]"
                    >
                        <a
                            :href="create().url"
                            class="text-emerald-500"
                            v-if="user"
                        >
                            <FileUp class="text-inherit" />
                            New share
                        </a>
                        <a
                            class="text-muted-foreground"
                            @click="highlightAuthentication"
                            v-else
                        >
                            <FileUp class="text-inherit" />
                            Log in to share a file
                        </a>
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
        <NavigationMenu class="mr-2 py-2">
            <NavigationMenuList class="h-full items-center space-x-2">
                <ThemeToggle />
                <NavigationMenuItem v-if="user">
                    <NavigationMenuTrigger>{{
                        user.name
                    }}</NavigationMenuTrigger>
                    <NavigationMenuContent>
                        <ul class="grid w-[300px] gap-4">
                            <li>
                                <NavigationMenuLink as-child>
                                    <a href="#">
                                        <div class="font-medium">Profile</div>
                                        <div class="text-muted-foreground">
                                            Tweak your account. 🪪
                                        </div>
                                    </a>
                                </NavigationMenuLink>
                                <NavigationMenuLink as-child>
                                    <a href="#">
                                        <div class="font-medium">My shares</div>
                                        <div class="text-muted-foreground">
                                            See your shared files. 🗃️
                                        </div>
                                    </a>
                                </NavigationMenuLink>
                                <NavigationMenuLink as-child>
                                    <a @click="sendLogout">
                                        <div
                                            class="text-destructive font-medium"
                                        >
                                            Logout
                                        </div>
                                        <div class="text-muted-foreground">
                                            Till we meet again! 👋
                                        </div>
                                    </a>
                                </NavigationMenuLink>
                            </li>
                        </ul>
                    </NavigationMenuContent>
                </NavigationMenuItem>

                <NavigationMenuItem id="auth-section" v-else>
                    <NavigationMenuLink
                        as-child
                        :class="[
                            navigationMenuTriggerStyle(),
                            'flex-row gap-2',
                        ]"
                    >
                        <a :href="register().url">Register</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink
                        as-child
                        :class="[
                            navigationMenuTriggerStyle(),
                            'flex-row gap-2',
                        ]"
                    >
                        <a :href="login().url">Login</a>
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
    </div>
</template>
