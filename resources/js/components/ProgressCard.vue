<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Task } from '@/types';
import { CalendarDate, DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import type { DateRange } from 'reka-ui';
import { computed, ref } from 'vue';
import Icon from './Icon.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from './ui/card';
import { Popover, PopoverContent, PopoverTrigger } from './ui/popover';
import { Progress } from './ui/progress';
import { RangeCalendar } from './ui/range-calendar';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from './ui/select';

const props = defineProps<{
    tasks: Task[];
}>();

const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const selectedMonth = ref(new Date().toLocaleString('default', { month: 'long' }));

const df = new DateFormatter('en-US', {
    dateStyle: 'medium',
});

const getMonthIndex = computed(() => {
    return months.indexOf(selectedMonth.value) + 1;
});

const value = computed<DateRange>(() => {
    const year = new Date().getFullYear();
    const month = getMonthIndex.value;

    const start = new CalendarDate(year, month, 1);
    const end = new CalendarDate(year, month, new Date(year, month, 0).getDate());

    return { start, end };
});

const statuses = [
    { name: 'Completed', color: 'text-green-500' },
    { name: 'In Progress', color: 'text-orange-500' },
    { name: 'Overdue', color: 'text-red-500' },
];

const allTasks = computed(() => {
    return props.tasks?.length;
});

const completedTasks = computed(() => {
    return props.tasks?.filter((task) => task.status === 'completed').length;
});

const taskProgressCalculation = computed(() => {
    return ((completedTasks.value || 0) / (allTasks.value || 1)) * 100;
});
</script>
<template>
    <Card class="w-full">
        <CardHeader class="border-b border-gray-100 pb-2">
            <CardTitle class="text-lg font-semibold tracking-tight"> Monthly Summary </CardTitle>
            <CardDescription class="text-sm"> Track your task completion progress for this month. </CardDescription>
            <div class="mt-4 flex items-center gap-2">
                <Popover>
                    <PopoverTrigger as-child>
                        <Button variant="outline" :class="cn('w-[280px] justify-start text-left font-normal', !value && 'text-muted-foreground')">
                            <CalendarIcon class="mr-2 h-4 w-4" />
                            <template v-if="value.start">
                                <template v-if="value.end">
                                    {{ df.format(value.start.toDate(getLocalTimeZone())) }} - {{ df.format(value.end.toDate(getLocalTimeZone())) }}
                                </template>

                                <template v-else>
                                    {{ df.format(value.start.toDate(getLocalTimeZone())) }}
                                </template>
                            </template>
                            <template v-else> Pick a date </template>
                        </Button>
                    </PopoverTrigger>
                    <PopoverContent class="w-auto p-0">
                        <RangeCalendar
                            v-model="value"
                            initial-focus
                            :number-of-months="2"
                            @update:start-value="(startDate) => (value.start = startDate)"
                        />
                    </PopoverContent>
                </Popover>
                <Select v-model="selectedMonth">
                    <SelectTrigger>
                        <SelectValue placeholder="Select a month" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Month</SelectLabel>
                            <SelectItem v-for="month in months" :key="month" :value="month">
                                {{ month }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
        </CardHeader>
        <CardContent>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <Progress :model-value="taskProgressCalculation" />
                    <span class="text-xs font-medium text-gray-500">{{ Math.round(taskProgressCalculation) }}%</span>
                </div>
                <p class="text-sm text-gray-600">
                    You've completed
                    <span class="font-semibold text-green-600">{{ completedTasks }}</span>
                    /
                    <span class="font-semibold text-gray-800">{{ allTasks }}</span>
                    tasks this month
                </p>
            </div>
        </CardContent>
        <CardFooter class="border-t border-gray-100 pt-2">
            <div class="flex w-full items-center gap-4">
                <div v-for="status in statuses" :key="status.name" class="flex items-center gap-1">
                    <Icon name="dot" stroke-width="8" :class="status.color" class="h-4 w-4" />
                    <span class="text-xs text-gray-500">{{ status.name }}</span>
                </div>
            </div>
        </CardFooter>
    </Card>
</template>
