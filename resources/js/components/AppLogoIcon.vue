<script setup lang="ts">
import { ChartNoAxesGantt } from 'lucide-vue-next';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <ChartNoAxesGantt class="size-5 fill-current text-white dark:text-black" v-bind="$attrs" :class="['size-5', className]" />
</template>
