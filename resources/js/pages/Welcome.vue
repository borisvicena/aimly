<script setup lang="ts">
import GoalList from '@/components/GoalList.vue';
import Heading from '@/components/Heading.vue';
import ProgressCard from '@/components/ProgressCard.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { computed, onMounted, onUpdated, ref } from 'vue';

const page = usePage();
const goals = ref<any>([]);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/',
    },
];

const allTasks = computed(() => {
    return goals.value.reduce((acc: any[], goal: any) => {
        return acc.concat(goal.tasks || []);
    }, []);
});

onMounted(() => {
    if (!page.props.goals) {
        console.error('Goals or tasks data is not available.');
        return;
    }
    goals.value = page.props.goals;
});

onUpdated(() => {
    if (page.props.goals) {
        goals.value = page.props.goals;
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mt-8 flex flex-1 flex-col justify-center p-4">
            <div class="mx-auto flex w-full max-w-xl flex-col items-center justify-center sm:max-w-2xl md:max-w-5xl">
                <div class="flex w-full items-center justify-start gap-4">
                    <Heading title="Dashboard" description="Welcome to your productivity dashboard" />
                </div>
                <ProgressCard :tasks="allTasks" />
            </div>
        </div>

        <section class="flex w-full flex-col items-center justify-center px-2">
            <div class="mt-4 w-full max-w-5xl items-center justify-center sm:mt-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold sm:text-2xl">My Goals</h2>
                        <p class="text-sm text-gray-500">Track your progress and stay focused.</p>
                    </div>
                    <Button as-child class="self-start sm:self-auto">
                        <TextLink :href="route('goal.create')">
                            <span class="flex items-center gap-2">
                                <Plus class="h-4 w-4" />
                                Create New Goal
                            </span>
                        </TextLink>
                    </Button>
                </div>
                <div class="mt-6 flex flex-wrap justify-between gap-6">
                    <GoalList :goals="goals" />
                </div>
                <div v-if="!goals || goals.length === 0" class="mt-8 flex flex-col items-center justify-center text-center text-gray-400">
                    <svg class="mb-2 h-10 w-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    <span>No goals yet. Start by creating your first goal!</span>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
