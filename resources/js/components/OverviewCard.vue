<script setup lang="ts">
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Activity } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{
    tasks: { status: string }[];
    goals: { status: string; deadline: string }[];
}>();

// TASKS
const totalTasks = computed(() => props.tasks.length);
const completedTasks = computed(() => props.tasks.filter((t) => t.status === 'completed').length);
const inProgressTasks = computed(() => props.tasks.filter((t) => t.status === 'in_progress').length);
const overdueTasks = computed(() => props.tasks.filter((t) => t.status === 'overdue').length);
const taskProgress = computed(() => (totalTasks.value === 0 ? 0 : Math.round((completedTasks.value / totalTasks.value) * 100)));

// GOALS
const totalGoals = computed(() => props.goals.length);
const completedGoals = computed(() => props.goals.filter((g) => g.status === 'completed').length);
const activeGoals = computed(() => props.goals.filter((g) => g.status === 'active').length);
const overdueGoals = computed(() => props.goals.filter((g) => g.status === 'overdue').length);
const goalProgress = computed(() => (totalGoals.value === 0 ? 0 : Math.round((completedGoals.value / totalGoals.value) * 100)));
</script>

<template>
    <Card class="h-full w-full sm:max-w-sm">
        <CardHeader class="flex flex-wrap items-center justify-between">
            <div class="flex flex-col">
                <CardTitle>Overview</CardTitle>
                <CardDescription>Combined task & goal progress.</CardDescription>
            </div>
            <Activity class="h-8 w-8 rounded-full bg-green-200 p-1.5 text-green-500" />
        </CardHeader>

        <CardContent>
            <Tabs default-value="tasks" class="w-full">
                <TabsList class="mb-4 grid w-full grid-cols-2">
                    <TabsTrigger value="tasks">Tasks</TabsTrigger>
                    <TabsTrigger value="goals">Goals</TabsTrigger>
                </TabsList>

                <!-- TASKS TAB -->
                <TabsContent value="tasks" class="space-y-5">
                    <div class="space-y-2">
                        <Progress :model-value="taskProgress" class="h-2" />
                        <p class="text-muted-foreground text-right text-xs">{{ taskProgress }}% Completed</p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b">
                            <span class="text-muted-foreground text-sm">Total</span>
                            <span class="text-foreground font-semibold">{{ totalTasks }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">Completed</span>
                            <span class="font-semibold text-green-600">{{ completedTasks }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">In Progress</span>
                            <span class="font-semibold text-orange-600">{{ inProgressTasks }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">Overdue</span>
                            <span class="font-semibold text-red-600">{{ overdueTasks }}</span>
                        </div>
                    </div>
                </TabsContent>

                <!-- GOALS TAB -->
                <TabsContent value="goals" class="space-y-5">
                    <div class="space-y-2">
                        <Progress :model-value="goalProgress" class="h-2" />
                        <p class="text-muted-foreground text-right text-xs">{{ goalProgress }}% Completed</p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b">
                            <span class="text-muted-foreground text-sm">Total</span>
                            <span class="text-foreground font-semibold">{{ totalGoals }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">Completed</span>
                            <span class="font-semibold text-green-600">{{ completedGoals }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">Active</span>
                            <span class="font-semibold text-blue-600">{{ activeGoals }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground text-sm">Overdue</span>
                            <span class="font-semibold text-red-600">{{ overdueGoals }}</span>
                        </div>
                    </div>
                </TabsContent>
            </Tabs>
        </CardContent>
    </Card>
</template>
