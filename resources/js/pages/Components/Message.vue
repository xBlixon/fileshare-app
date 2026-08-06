<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const props = withDefaults(
    defineProps<{
        type?: 'success' | 'neutral' | 'error';
        message: string | unknown;
        duration?: number;
    }>(),
    {
        type: 'neutral',
        duration: 4000,
    },
);

const messageStyles = {
    success: 'bg-green-600 text-accent',
    neutral: 'bg-accent-foreground text-accent', // message
    error: 'bg-red-400 text-black',
};

const style = messageStyles[props.type];

const emit = defineEmits<{
    (e: 'close'): void;
}>();

const isVisible = ref(true);
let timer: ReturnType<typeof setTimeout> | null = null;

function close() {
    isVisible.value = false;
}

function onAfterLeave() {
    emit('close');
}

onMounted(() => {
    timer = setTimeout(() => {
        close();
    }, props.duration);
});

onUnmounted(() => {
    if (timer) {
        clearTimeout(timer);
    }
});
</script>

<template>
    <Transition name="fade" @after-leave="onAfterLeave">
        <div
            :class="
                'flex items-center justify-center ' +
                'fixed bottom-0 right-0 m-4 rounded-xl px-4 py-2 ' +
                style
            "
            v-if="isVisible"
        >
            {{ message }}
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition:
        opacity 0.4s ease,
        transform 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
