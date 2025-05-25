<script setup lang="ts">
import TaskForm from '@/components/TaskForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Goal } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

const page = usePage();
const goal = ref<Goal | null>(null);
const breadcrumbs = computed<BreadcrumbItem[]>(() => [
    {
        title: 'Dashboard',
        href: '/',
    },
    {
        title: 'Goal: ' + goal.value?.title || 'Goal',
        href: route('goal.show', goal.value?.id || ''),
    },
    {
        title: 'Create Task',
        href: route('goal.task.create', goal.value?.id || ''),
    },
]);

onMounted(() => {
    goal.value = page.props.goal as Goal;
});
</script>
<template>
    <Head title="Create Task" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <section class="flex aspect-video w-full flex-col items-center justify-center px-2">
            <div class="w-full max-w-xl sm:max-w-2xl md:max-w-3xl">
                <TaskForm :goal="goal" />
            </div>
        </section>
    </AppLayout>
</template>
