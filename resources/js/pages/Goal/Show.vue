<script setup lang="ts">
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import TaskList from '@/components/TaskList.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { useInertiaRouter } from '@/composables/useInertiaRouter';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Goal } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Plus, Trash2 } from 'lucide-vue-next';
import { computed, onMounted, onUpdated, ref } from 'vue';
import { toast } from 'vue-sonner';

const page = usePage();
const inertia = useInertiaRouter();
const goal = ref<Goal | null>(null);

const allTasks = computed(() => {
    return goal.value?.tasks.length;
});

const completedTasks = computed(() => {
    return goal.value?.tasks.filter((task) => task.status === 'completed').length;
});

const taskProgressCalculation = computed(() => {
    return ((completedTasks.value || 0) / (allTasks.value || 1)) * 100;
});

const breadcrumbs = computed<BreadcrumbItem[]>(() => [
    {
        title: 'Dashboard',
        href: '/',
    },
    {
        title: 'Goal: ' + goal.value?.title || 'Goal',
        href: route('index'),
    },
]);

const getGoalStatusColor = (status: string) => {
    switch (status) {
        case 'active':
            return 'bg-success text-success-foreground';
        case 'completed':
            return 'bg-blue-100 text-blue-800';
        case 'overdue':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
};

const getGoalStatusText = (status: string) => {
    switch (status) {
        case 'active':
            return 'Active';
        case 'completed':
            return 'Completed';
        case 'overdue':
            return 'Overdue';
        default:
            return 'Unknown Status';
    }
};

const onClickEditGoal = () => {
    if (goal.value && goal.value.id) {
        inertia.visit(route('goal.edit', goal.value.id), {
            onError: (error: any) => {
                toast.error('Error: ' + error.message, {
                    description: 'There was an error while trying to edit the goal. Please try again later.',
                });
                console.error('Error navigating to edit goal:', error);
            },
        });
    }
};

const goalStatusBadge = computed(() => {
    const status = goal.value?.status.toLowerCase();
    switch (status) {
        case 'completed':
            return { class: 'bg-green-100 text-green-800' };
        case 'active':
            return { class: 'bg-blue-100 text-blue-800' };
        case 'overdue':
            return { class: 'bg-red-100 text-red-800' };
        default:
            return { class: 'bg-gray-100 text-gray-800' };
    }
});

const deleteGoal = () => {
    if (goal.value && goal.value.id) {
        inertia.delete(route('goal.destroy', goal.value.id), {
            onSuccess: () => {
                toast.success('Goal deleted successfully!', {
                    description: 'Your goal and all associated tasks have been removed.',
                });
                inertia.visit(route('index'));
            },
            onError: (error: any) => {
                toast.error('Error: ' + error.message, {
                    description: 'There was an error while trying to delete the goal. Please try again later.',
                });
                console.error('Error deleting goal:', error);
            },
        });
    }
    return '';
};

const progressPercentage = computed(() => ((completedTasks.value || 0) / (allTasks.value || 1)) * 100);

const progressColor = computed(() => {
    const percent = progressPercentage.value;
    if (percent >= 80) return 'bg-green-500';
    if (percent >= 40) return 'bg-yellow-500';
    return 'bg-red-500';
});

onMounted(() => {
    goal.value = page.props.goal as Goal;
});

onUpdated(() => {
    if (page.props.goal) {
        goal.value = page.props.goal as Goal;
    }
});
</script>
<template>
    <Head :title="goal?.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <section class="flex aspect-video w-full flex-col items-center justify-center px-0 py-4">
            <div class="w-full max-w-xl sm:max-w-2xl md:max-w-3xl">
                <Card class="group w-full shadow-lg">
                    <CardHeader class="flex items-start justify-between space-y-1.5">
                        <div class="flex flex-col">
                            <CardTitle class="fon-semibold line-clamp-2 text-2xl tracking-tight">{{ goal?.title }}</CardTitle>
                            <CardDescription class="text-muted-foreground line-clamp-3 text-lg">
                                {{ goal?.description }}
                            </CardDescription>
                            <div class="text-muted-foreground mt-4 flex flex-wrap gap-1 text-sm">
                                <span
                                    v-if="goal?.status"
                                    class="bg-accent rounded-full px-2.5 py-1 text-sm font-medium capitalize"
                                    :class="goalStatusBadge.class"
                                >
                                    {{ goal.status }}
                                </span>
                                <span v-if="goal?.deadline" class="bg-accent rounded-full px-2.5 py-1 text-sm font-medium">
                                    {{ new Date(goal.deadline).toLocaleDateString('en-US', { dateStyle: 'long' }) }}
                                </span>
                            </div>
                        </div>
                        <ConfirmDialog
                            type="goal"
                            title="Delete Goal"
                            variant="destructive"
                            :icon="Trash2"
                            :model-title="goal?.title"
                            :description="'Are you sure you want to delete this goal?'"
                            @confirm="deleteGoal"
                        />
                    </CardHeader>

                    <!-- Content -->
                    <CardContent class="flex flex-col gap-4 px-0 pt-0">
                        <div class="px-6">
                            <div class="bg-muted relative h-2 w-full overflow-hidden rounded-full">
                                <div
                                    class="h-full transition-all duration-300"
                                    :class="progressColor"
                                    :style="{ width: progressPercentage + '%' }"
                                ></div>
                            </div>
                            <div class="mt-1 flex items-center justify-between text-xs">
                                <p class="text-muted-foreground">{{ completedTasks }}/{{ allTasks }} tasks completed</p>
                                <p class="text-muted-foreground">{{ Math.round(progressPercentage) }}%</p>
                            </div>
                        </div>
                        <div class="bg-accent mt-4 flex w-full items-center justify-between px-6 py-4">
                            <div class="flex flex-col justify-start">
                                <h6 class="text-lg font-semibold">Tasks</h6>
                                <p class="text-sm text-gray-500">Manage your tasks related to this goal.</p>
                            </div>
                            <Button as-child v-if="goal && goal.id">
                                <Link :href="route('goal.task.create', goal.id)">
                                    <span class="flex items-center gap-2">
                                        <Plus class="h-4 w-4" />
                                        Create New Task
                                    </span>
                                </Link>
                            </Button>
                        </div>
                    </CardContent>
                    <CardFooter class="flex w-full flex-col items-stretch px-6">
                        <TaskList :tasks="goal?.tasks ?? []" />
                    </CardFooter>
                </Card>
            </div>
        </section>
    </AppLayout>
</template>
