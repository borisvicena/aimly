<script setup lang="ts">
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import TaskList from '@/components/TaskList.vue';
import TextLink from '@/components/TextLink.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Goal } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { computed, onMounted, onUpdated, ref } from 'vue';
import { toast } from 'vue-sonner';

const page = usePage();
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
        router.visit(route('goal.edit', goal.value.id), {
            preserveScroll: true,
            preserveState: true,
        });
    }
};

const deleteGoal = () => {
    if (goal.value && goal.value.id) {
        return router.delete(route('goal.destroy', goal.value.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Goal deleted successfully!', {
                    description: 'Your goal and all associated tasks have been removed.',
                });
                router.visit(route('index'), {
                    preserveState: true,
                });
            },
            onError: (error) => {
                toast.error('Error: ' + error.message, {
                    description: 'There was an error while trying to delete the goal. Please try again later.',
                });
                console.error('Error deleting goal:', error);
            },
        });
    }
    return '';
};

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
                <Card class="w-full gap-0 shadow-lg">
                    <CardHeader>
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <CardTitle class="text-2xl font-bold">{{ goal?.title }}</CardTitle>
                                <CardDescription class="mt-2 space-y-4 text-base">
                                    <p class="mb-2 text-gray-700" v-if="goal?.description">{{ goal.description }}</p>
                                    <div class="mt-8 flex flex-col gap-2">
                                        <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
                                            <Badge v-if="goal?.status" :class="getGoalStatusColor(goal.status)">
                                                {{ getGoalStatusText(goal.status) }}
                                            </Badge>
                                            <Badge v-if="goal?.deadline" variant="secondary" class="text-gray-500">
                                                {{ new Date(goal.deadline).toLocaleDateString('en-US', { dateStyle: 'long' }) }}
                                            </Badge>
                                        </div>
                                        <Progress :model-value="taskProgressCalculation" />
                                        <div class="mt-1 flex justify-between text-xs text-gray-400">
                                            <span>{{ completedTasks }} completed</span>
                                            <span class="text-primary font-semibold">{{ taskProgressCalculation.toFixed(0) }}%</span>
                                            <span>{{ allTasks }} total</span>
                                        </div>
                                    </div>
                                </CardDescription>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-start gap-2">
                            <Button size="sm" @click.prevent="onClickEditGoal"> Edit Goal</Button>
                            <ConfirmDialog
                                type="goal"
                                title="Delete Goal"
                                description="Are you sure you want to delete this goal?"
                                :modelTitle="goal?.title"
                                @confirm="deleteGoal"
                            />
                        </div>
                    </CardHeader>
                    <CardContent class="mt-8 flex items-center justify-between bg-gray-100 py-4">
                        <div class="flex flex-col justify-start">
                            <h6 class="text-lg font-semibold">Tasks</h6>
                            <p class="text-sm text-gray-500">Manage your tasks related to this goal.</p>
                        </div>
                        <Button as-child v-if="goal && goal.id">
                            <TextLink :href="route('goal.task.create', goal.id)">
                                <span class="flex items-center gap-2">
                                    <Plus class="h-4 w-4" />
                                    Create New Task
                                </span>
                            </TextLink>
                        </Button>
                    </CardContent>
                    <CardFooter class="flex w-full flex-col items-stretch px-0">
                        <TaskList :tasks="goal?.tasks ?? []" />
                    </CardFooter>
                </Card>
            </div>
        </section>
    </AppLayout>
</template>
