<script setup lang="ts">
import GoalForm from '@/components/GoalForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/',
    },
    {
        title: 'Create Goal',
        href: '/goal/create',
    },
];
</script>
<template>
    <Head title="Create Goal" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <section class="flex aspect-video w-full flex-col items-center justify-center px-2">
            <div class="w-full max-w-xl sm:max-w-2xl md:max-w-3xl">
                <GoalForm />
            </div>
        </section>
    </AppLayout>
</template>
