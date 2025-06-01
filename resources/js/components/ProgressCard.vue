<script setup lang="ts">
import { Task } from '@/types';
import { Flag } from 'lucide-vue-next';
import { computed } from 'vue';
import Icon from './Icon.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from './ui/card';

const props = defineProps<{
    tasks: Task[];
}>();

// Task summaries
const allTasks = computed(() => props.tasks.length);
const completedTasks = computed(() => props.tasks.filter((t) => t.status === 'completed').length);

// Status labels
const statuses = [
    { name: 'Completed', color: 'text-green-500' },
    { name: 'In Progress', color: 'text-orange-500' },
    { name: 'Overdue', color: 'text-red-500' },
];
</script>

<template>
    <Card class="w-full">
        <CardHeader class="flex flex-wrap items-center justify-between">
            <div class="flex flex-col">
                <CardTitle>Monthly Summary</CardTitle>
                <CardDescription> Track your task completion progress for this month. </CardDescription>
            </div>

            <Flag class="h-8 w-8 rounded-full bg-blue-200 p-1.5 text-blue-500" />
        </CardHeader>
        <CardContent class="space-y-4">
            <!-- Completion summary -->
            <p class="text-muted-foreground text-sm">
                You’ve completed
                <span class="font-semibold text-green-600">{{ completedTasks }}</span> /
                <span class="text-foreground font-semibold">{{ allTasks }}</span>
                tasks this month.
            </p>
        </CardContent>

        <CardFooter>
            <div class="flex w-full items-center gap-4">
                <div v-for="status in statuses" :key="status.name" class="flex items-center gap-1">
                    <Icon name="dot" stroke-width="8" :class="status.color" class="h-4 w-4" />
                    <span class="text-muted-foreground text-xs">
                        {{ status.name }}
                    </span>
                </div>
            </div>
        </CardFooter>
    </Card>
</template>
