<script setup lang="ts">
import { Task } from '@/types';
import TaskItem from './TaskItem.vue';

const props = defineProps<{
    tasks: Task[];
}>();
</script>
<template>
    <div v-for="task in props.tasks" :key="task.id" class="w-ful flex flex-col">
        <TaskItem :id="task.id" :title="task.title" :due_date="task.due_date" :status="task.status" />
    </div>
</template>
