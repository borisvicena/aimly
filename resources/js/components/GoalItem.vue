<script setup lang="ts">
import { Task } from '@/types';
import { computed } from 'vue';
import TaskList from './TaskList.vue';
import TextLink from './TextLink.vue';
import { Button } from './ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from './ui/card';
import { Progress } from './ui/progress';

const props = defineProps<{
    id: number;
    title: string;
    description: string;
    deadline: string;
    status: string;
    tasks: Task[];
}>();

const allTasks = computed(() => {
    return props.tasks.length;
});

const completedTasks = computed(() => {
    return props.tasks?.filter((task) => task.status === 'completed').length;
});

const taskProgressCalculation = computed(() => {
    return ((completedTasks.value || 0) / (allTasks.value || 1)) * 100;
});
</script>
<template>
    <Card class="w-full flex-shrink-0 gap-3 pt-6 pb-3 sm:w-[350px] md:w-[400px] lg:w-[500px]">
        <CardHeader class="space-y-1">
            <div class="flex items-center justify-between">
                <CardTitle>{{ props.title }}</CardTitle>
                <p class="text-primary">{{ taskProgressCalculation.toFixed(0) }}%</p>
            </div>
            <CardDescription>
                <Progress :model-value="taskProgressCalculation" />
            </CardDescription>
        </CardHeader>
        <CardContent class="w-full px-0">
            <TaskList :tasks="props.tasks" />
        </CardContent>
        <hr />
        <CardFooter>
            <Button as-child variant="link" class="w-full">
                <TextLink :href="route('goal.show', { id: props.id })">View Goal Details</TextLink>
            </Button>
        </CardFooter>
    </Card>
</template>
