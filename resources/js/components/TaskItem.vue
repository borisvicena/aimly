<script setup lang="ts">
import { useInertiaRouter } from '@/composables/useInertiaRouter';
import { Check, Timer, TimerOff } from 'lucide-vue-next';
import { toast } from 'vue-sonner';
import ConfirmDialog from './ConfirmDialog.vue';

const inertia = useInertiaRouter();

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

const getStatus = (status: string) => {
    return (
        statuses.find((s) => s.status === status) || {
            name: 'Invalid',
            color: 'text-gray-400',
        }
    );
};

const onClickChangeStatus = () => {
    inertia.post(route('task.update', { id: props.id }), {
        onSuccess: () => {
            toast.success('Task status updated!');
        },
        onError: (error: any) => {
            toast.error('Failed to update task status');
            console.error(error);
        },
    });
};

const deleteTask = () => {
    inertia.delete(route('task.destroy', props.id), {
        onSuccess: () => {
            toast.success('Task deleted successfully');
        },
        onError: (error: any) => {
            toast.error('Failed to delete task');
            console.error(error);
        },
    });
};

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
    });
};
</script>

<template>
    <div
        class="group hover:bg-muted flex w-full cursor-pointer items-center justify-between gap-3 rounded-lg px-4 py-3 transition"
        @click.stop.prevent="onClickChangeStatus"
    >
        <!-- Left Side -->
        <div class="flex flex-1 items-center gap-2">
            <!-- Status Circle -->
            <div
                :class="[
                    'flex h-9 w-9 items-center justify-center rounded-full border transition',
                    props.status === 'completed' ? 'border-green-500 bg-green-500' : 'border-muted-foreground/20',
                ]"
            >
                <Check v-if="props.status === 'completed'" class="h-4 w-4 text-white" />
                <Timer v-else-if="props.status === 'in_progress'" class="text-muted-foreground h-4 w-4" />
                <TimerOff v-else="props.status === 'overdue'" class="text-muted-foreground h-4 w-4" />
            </div>

            <!-- Task Info -->
            <div class="flex flex-1 flex-col">
                <span :class="['text-sm font-medium', props.status === 'completed' ? 'text-muted-foreground line-through' : 'text-foreground']">
                    {{ props.title }}
                </span>
                <div class="text-muted-foreground text-xs">
                    <span :class="getStatus(props.status).color">
                        {{ getStatus(props.status).name }}
                    </span>
                    <span class="mx-1">•</span>
                    <span>Due: {{ formatDate(props.due_date) }}</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Actions -->
        <ConfirmDialog
            type="task"
            :description="'Are you sure you want to delete this task?'"
            :modelTitle="props.title"
            variant="ghost"
            class="text-muted-foreground opacity-0 transition group-hover:opacity-100 hover:text-red-500"
            @confirm="deleteTask"
        />
    </div>
</template>
