<script setup lang="ts">
import type { LucideIcon} from '@lucide/vue';
import { MonitorCog, Moon, Sun } from '@lucide/vue';
import { useColorMode } from '@vueuse/core';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';

const mode = useColorMode();
function toggleTheme() {
    const nextTheme: Record<string, 'light' | 'dark' > = {
        dark: 'light',
        light: 'dark',
    };

    mode.value = nextTheme[mode.value] || 'dark';
}

const iconMap = {
    dark: Moon,
    light: Sun,
};

const labelMap = {
    dark: 'Dark',
    light: 'Light',
}

const themeIcon = computed<LucideIcon>(() => {
    return iconMap[mode.value];
});

const themeLabel = computed<string>(() => labelMap[mode.value]);


</script>

<template>
    <Button @click="toggleTheme">
        <component :is="themeIcon"></component>
        {{ themeLabel }}
    </Button>
</template>

<style scoped></style>
