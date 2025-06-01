<script setup lang="ts">
import AdvancedFilterCard from '@/components/AdvancedFilterCard.vue';
import GoalList from '@/components/GoalList.vue';
import Heading from '@/components/Heading.vue';
import OverviewCard from '@/components/OverviewCard.vue';
import ProgressCard from '@/components/ProgressCard.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Goal } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { computed, onMounted, onUpdated, ref, watch } from 'vue';

// Page props
const page = usePage();

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/',
    },
];

// Refs
const goals = ref<Goal[]>([]);
const filterType = ref('month');
const status = ref('All');
const searchInput = ref('');
const selectedMonth = ref(new Date().toLocaleString('default', { month: 'long' }));
const selectedMonthInternal = ref(selectedMonth);

// Computed properties
const filteredList = computed(() => {
    if (filterType.value === 'month') {
        return filteredGoals.value;
    }

    return goals.value;
});

const filteredByStatus = computed(() => {
    if (searchInput.value) {
        return filteredList.value.filter((goal: any) => {
            return goal.title.toLowerCase().includes(searchInput.value.toLowerCase());
        });
    }

    if (status.value === 'All') {
        return filteredList.value;
    }

    return filteredList.value.filter((goal: any) => {
        return goal.status === status.value.toLocaleLowerCase();
    });
});

const allTasks = computed(() => {
    return goals.value.reduce((acc: any[], goal: any) => {
        return acc.concat(goal.tasks || []);
    }, []);
});

const getMonthIndex = computed(() => {
    const monthNames = Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString('default', { month: 'long' }));
    return monthNames.indexOf(selectedMonth.value) + 1;
});

const filteredGoals = computed(() => {
    const year = new Date().getFullYear();
    const month = getMonthIndex.value - 1;

    const start = new Date(year, month, 1, 0, 0, 0, 0);
    const end = new Date(year, month + 1, 0, 23, 59, 59, 999);

    return goals.value.filter((goal: any) => {
        const deadline = new Date(goal.deadline);
        return deadline >= start && deadline <= end;
    });
});

// Event emitters
const emit = defineEmits<{
    (e: 'update:selectedMonth', value: string): void;
}>();

// Watchers
watch(selectedMonthInternal, (val: any) => emit('update:selectedMonth', val));

// Lifecycle hooks
onMounted(() => {
    if (!page.props.goals) {
        console.error('Goals or tasks data is not available.');
        return;
    }
    goals.value = page.props.goals as Goal[];
});

onUpdated(() => {
    if (page.props.goals) {
        goals.value = page.props.goals as Goal[];
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mt-8 flex flex-col justify-center px-4">
            <div class="mx-auto flex w-full max-w-xl flex-col items-center justify-center sm:max-w-2xl md:max-w-7xl">
                <div class="flex w-full items-center justify-start gap-4">
                    <Heading title="Dashboard" description="Welcome to your productivity dashboard" />
                </div>
                <div class="sm:items-between flex w-full flex-col gap-4 sm:flex-row sm:justify-center">
                    <div class="sm:flex-center flex w-full flex-col justify-between gap-4 sm:items-center">
                        <ProgressCard :tasks="allTasks" />
                        <AdvancedFilterCard
                            v-model:selected-month="selectedMonth"
                            v-model:filter-type="filterType"
                            v-model:status="status"
                            v-model:search-input="searchInput"
                        />
                    </div>
                    <OverviewCard :goals="goals" :tasks="allTasks" />
                </div>
            </div>

            <section class="mt-12 mb-8 w-full">
                <div class="mb-4 flex flex-wrap justify-start gap-4 sm:justify-between">
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold sm:text-2xl">My Goals</h2>
                        <p class="text-muted-foreground text-base">Track your progress and stay focused.</p>
                    </div>
                    <Button as-child class="w-full self-start sm:w-auto sm:self-auto">
                        <Link :href="route('goal.create')">
                            <span class="flex items-center gap-2">
                                <Plus class="h-4 w-4" />
                                Create New Goal
                            </span>
                        </Link>
                    </Button>
                </div>
                <GoalList :goals="filteredByStatus" />
            </section>
        </div>
    </AppLayout>
</template>
