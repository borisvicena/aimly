<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Check, Timer, Trash } from 'lucide-vue-next';
import { toast } from 'vue-sonner';
import ConfirmDialog from './ConfirmDialog.vue';
import Icon from './Icon.vue';
import { CardTitle } from './ui/card';

const props = defineProps<{
    id: number;
    title: string;
    due_date: string;
    status: string;
}>();

const statuses = [
    { status: 'completed', name: 'Completed', color: 'text-green-500' },
    { status: 'in_progress', name: 'In Progress', color: 'text-orange-500' },
    { status: 'overdue', name: 'Overdue', color: 'text-red-500' },
];

const getStatusColor = (status: string) => {
    const found = statuses.find((s) => s.status === status);
    return found ? found.color : 'Invalid Status';
};

const getStatusName = (status: string) => {
    const found = statuses.find((s) => s.status === status);
    return found ? found.name : 'Invalid Status';
};

const onClickChangeStatus = () => {
    router.post(
        route('task.update', { id: props.id }),
        {},
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                console.log('Status updated successfully');
            },
            onError: (error) => {
                console.error('Error updating status:', error);
            },
        },
    );
};

const deleteTask = () => {
    router.delete(route('task.destroy', props.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('Task deleted successfully', {
                description: 'The task has been removed from your list.',
            });
        },
        onError: (error) => {
            console.error('Error deleting task:', error);
            toast.error('Failed to delete task', {
                description: 'There was an error removing the task. Please try again.',
            });
        },
    });
};

const getMonthDayDate = (due_date: string) => {
    const date = new Date(due_date);
    const month = date.toLocaleString('en-EN', { month: 'short' });
    const day = date.getDate();

    return month + ' ' + day;
};
</script>
<template>
    <div
        :class="[props.status === 'completed' ? 'bg-gray-400/[0.1]' : '', 'pa-0 w-full p-4 hover:bg-gray-400/[0.1] active:bg-gray-400/[0.2]']"
        @click.stop.prevent="onClickChangeStatus"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-center space-x-2">
                <div :class="[props.status === 'completed' ? 'bg-green-500' : '', 'flex h-8 w-8 items-center justify-center rounded-full border']">
                    <Check v-if="props.status === 'completed'" class="h-4 w-4" color="white" />
                    <Timer v-else class="h-4 w-4" color="gray" />
                </div>
                <div>
                    <CardTitle :class="(props.status === 'completed' ? 'text-gray-400 line-through ' : '') + 'text-sm'">{{ props.title }}</CardTitle>
                    <div class="flex items-center justify-start space-x-1.5 text-sm font-medium">
                        <p :class="getStatusColor(props.status)">{{ getStatusName(props.status) }}</p>
                        <p class="text-gray-400">Due: {{ getMonthDayDate(props.due_date) }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <Icon name="dot" stroke-width="6" :class="getStatusColor(props.status)" class="h-5 w-5" />
                <ConfirmDialog
                    type="task"
                    title="Delete Task"
                    description="Are you sure you want to delete this task?"
                    :modelTitle="props.title"
                    @confirm="deleteTask"
                    :icon="Trash"
                />
            </div>
        </div>
    </div>
</template>
