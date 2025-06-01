<script setup lang="ts">
import { useInertiaRouter } from '@/composables/useInertiaRouter';
import { Goal } from '@/types';
import { Link } from '@inertiajs/vue3';
import { MessageSquareWarning, Trash2 } from 'lucide-vue-next';
import { computed, watch } from 'vue';
import { toast } from 'vue-sonner';
import ConfirmDialog from './ConfirmDialog.vue';
import TaskList from './TaskList.vue';
import { Button } from './ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from './ui/card';
import CardDescription from './ui/card/CardDescription.vue';

const inertia = useInertiaRouter();
const props = defineProps<{ goal: Goal }>();

const allTasks = computed(() => props.goal.tasks.length);
const completedTasks = computed(() => props.goal.tasks.filter((t) => t.status === 'completed').length);
const progressPercentage = computed(() => ((completedTasks.value || 0) / (allTasks.value || 1)) * 100);

const deleteGoal = () => {
    if (!props.goal?.id) return;

    inertia.delete(route('goal.destroy', props.goal.id), {
        onSuccess: () => {
            toast.success('Goal deleted successfully!');
            inertia.visit(route('index'));
        },
        onError: (error: any) => {
            toast.error('Error deleting goal: ' + error.message);
        },
    });
};

const allStatusesCompleted = computed(() => {
    return props.goal.tasks.filter((t) => t.status === 'completed').length === props.goal.tasks.length;
});

watch(
    () => allStatusesCompleted.value,
    () => {
        if (allStatusesCompleted.value === true && props.goal.status === 'completed') {
            return;
        }
        updateGoalStatus(props.goal.id);
    },
);

const progressColor = computed(() => {
    const percent = progressPercentage.value;
    if (percent >= 80) return 'bg-green-500';
    if (percent >= 40) return 'bg-yellow-500';
    return 'bg-red-500';
});

const goalStatusBadge = computed(() => {
    const status = props.goal.status.toLowerCase();
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

const updateGoalStatus = (goalId: number) => {
    inertia.post(route('goal.update', goalId), {
        onSuccess: () => {
            toast.success('Goal status updated');
        },
        onError: () => {
            toast.error('Failed to update goal status');
        },
    });
};
</script>

<template>
    <Card class="group border-border w-full transition-shadow duration-500 hover:shadow-lg">
        <CardHeader class="flex items-start justify-between space-y-1.5">
            <div class="flex flex-col">
                <CardTitle class="line-clamp-2 text-lg font-semibold tracking-tight">
                    {{ props.goal.title }}
                </CardTitle>
                <CardDescription class="text-muted-foreground line-clamp-2">
                    {{ props.goal.description || 'No description provided.' }}
                </CardDescription>
                <div class="text-muted-foreground mt-4 flex flex-wrap gap-1 text-sm">
                    <span class="bg-accent rounded-full px-2 py-0.5 text-xs font-medium capitalize" :class="goalStatusBadge.class">
                        {{ props.goal.status }}
                    </span>
                    <span class="bg-accent rounded-full px-2 py-0.5 text-xs font-medium">
                        {{ new Date(goal.deadline).toLocaleDateString('en-US', { dateStyle: 'long' }) }}
                    </span>
                </div>
            </div>

            <ConfirmDialog
                type="goal"
                title="Delete Goal"
                variant="destructive"
                :icon="Trash2"
                :model-title="props.goal.title"
                :description="'Are you sure you want to delete this goal?'"
                @confirm="deleteGoal"
            />
        </CardHeader>

        <!-- Content -->
        <CardContent class="flex flex-col gap-4 pt-0">
            <div>
                <div class="bg-muted relative h-2 w-full overflow-hidden rounded-full">
                    <div class="h-full transition-all duration-300" :class="progressColor" :style="{ width: progressPercentage + '%' }"></div>
                </div>
                <div class="mt-1 flex items-center justify-between text-xs">
                    <p class="text-muted-foreground">{{ completedTasks }}/{{ allTasks }} tasks completed</p>
                    <p class="text-muted-foreground">{{ Math.round(progressPercentage) }}%</p>
                </div>
            </div>

            <div class="space-y-2">
                <template v-if="props.goal.tasks.length">
                    <TaskList :tasks="props.goal.tasks" />
                </template>
                <template v-else class="flex flex-col items-center justify-center space-y-2">
                    <MessageSquareWarning class="text-muted-foreground mx-auto h-6 w-6" />
                    <p class="text-muted-foreground text-center text-sm">No tasks added to this goal.</p>
                    <Button variant="link" class="w-full" as-child>
                        <Link :href="route('goal.task.create', { goal: props.goal.id })">Add Task</Link>
                    </Button>
                </template>
            </div>
        </CardContent>

        <!-- Footer -->
        <CardFooter class="mt-auto w-full justify-center pt-4">
            <Button variant="link" class="font-medium" as-child>
                <Link :href="route('goal.show', { id: props.goal.id })"> View Goal Details </Link>
            </Button>
        </CardFooter>
    </Card>
</template>
