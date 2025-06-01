<template>
    <button
        :title="tooltip"
        type="button"
        @click="$emit('click')"
        class="group relative isolate inline-flex items-center justify-center rounded-full p-2 text-red-600 transition-all duration-300 ease-out hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 dark:text-red-400"
        :class="computedClass"
    >
        <!-- Soft radial glow -->
        <span
            class="absolute inset-0 z-0 rounded-full bg-red-500 opacity-0 blur-2xl transition duration-500 group-hover:opacity-10 group-active:opacity-20"
        ></span>

        <!-- Inner ripple ping -->
        <span class="absolute inset-0 z-0 animate-ping rounded-full bg-red-400 opacity-0 group-hover:opacity-10"></span>

        <!-- Icon Slot -->
        <component
            :is="icon"
            class="relative z-10 h-5 w-5 transition-transform duration-300 group-hover:scale-125 group-hover:rotate-6 group-active:scale-95"
        />
    </button>
</template>

<script setup lang="ts">
import type { Component } from 'vue';
import { computed } from 'vue';

const props = defineProps<{
    icon: Component;
    tooltip?: string;
    intent?: 'danger' | 'primary' | 'secondary' | 'ghost-muted';
}>();

const computedClass = computed(() => {
    switch (props.intent) {
        case 'danger':
            return 'bg-red-50 dark:bg-red-900/20 active:bg-red-200';
        case 'primary':
            return 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 active:bg-blue-200';
        case 'secondary':
            return 'bg-gray-50 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400 active:bg-gray-200';
        case 'ghost-muted':
            return 'bg-transparent text-muted-foreground hover:text-red-500 dark:hover:text-red-400 transition-colors';

        default:
            return 'bg-red-50 dark:bg-red-900/20 active:bg-red-200';
    }
});
</script>

<style scoped>
button:focus-visible {
    outline: none;
}
</style>
