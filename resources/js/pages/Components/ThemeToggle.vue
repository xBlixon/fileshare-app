<script setup lang="ts">
import type { LucideIcon } from '@lucide/vue';
import { MonitorCog, Moon, Sun } from '@lucide/vue';
import { useColorMode } from '@vueuse/core';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import ClientOnly from '@/pages/Components/ClientOnly.vue';

const mode = useColorMode();
function toggleTheme() {
    const nextTheme: Record<string, 'light' | 'dark' | 'auto'> = {
        auto: 'dark',
        dark: 'light',
        light: 'auto',
    };

    mode.value = nextTheme[mode.value] || 'auto';
}

const iconMap = {
    auto: MonitorCog,
    dark: Moon,
    light: Sun,
};

const labelMap = {
    auto: 'System',
    dark: 'Dark',
    light: 'Light',
};

const themeIcon = computed<LucideIcon>(() => {
    return iconMap[mode.value];
});

const themeLabel = computed<string>(() => labelMap[mode.value]);
</script>

<template>
    <Button @click="toggleTheme" variant="outline">
        <ClientOnly>
            <component :is="themeIcon"></component>
            {{ themeLabel }}
            <template #server>
                <MonitorCog />
                System
            </template>
        </ClientOnly>
    </Button>
</template>

<style scoped></style>
