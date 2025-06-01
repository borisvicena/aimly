<script setup lang="ts">
import { CalendarDate, DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import { computed } from 'vue';
import { Button } from './ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from './ui/card';
import { Input } from './ui/input';
import { Popover, PopoverTrigger } from './ui/popover';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from './ui/select';

// Models
const selectedMonth = defineModel<string>('selectedMonth');
const searchInput = defineModel<string>('searchInput');
const filterType = defineModel<string>('filterType');
const status = defineModel<string>('status');

// Date Formatter
const df = new DateFormatter('en-US', { dateStyle: 'medium' });

// Constants
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const filterOptions = ['month', 'all'];
const statusOptions = ['All', 'Overdue', 'Active', 'Completed'];

// Computed properties
const getMonthIndex = computed(() => {
    return months.indexOf(selectedMonth.value + '') + 1;
});

const selectedRange = computed(() => {
    if (filterType.value !== 'month') return null;
    const year = new Date().getFullYear();
    const month = getMonthIndex.value;
    const start = new CalendarDate(year, month, 1);
    const end = new CalendarDate(year, month, new Date(year, month, 0).getDate());
    return { start, end };
});
</script>

<template>
    <Card class="w-full">
        <CardHeader class="flex flex-wrap items-center justify-between">
            <div class="flex flex-col">
                <CardTitle>Advanced Filter</CardTitle>
                <CardDescription>Filter tasks based on various criteria.</CardDescription>
            </div>

            <Popover v-if="filterType === 'month' && selectedRange">
                <PopoverTrigger as-child>
                    <Button size="sm" variant="outline" class="w-full justify-start text-left font-normal sm:w-[230px]">
                        <CalendarIcon class="mr-2 h-4 w-4" />
                        {{ df.format(selectedRange.start.toDate(getLocalTimeZone())) }} -
                        {{ df.format(selectedRange.end.toDate(getLocalTimeZone())) }}
                    </Button>
                </PopoverTrigger>
            </Popover>
        </CardHeader>

        <CardContent class="flex flex-col items-start gap-2 sm:flex-row sm:items-center">
            <!-- Filter Type Select -->
            <Select v-model="filterType">
                <SelectTrigger class="w-full sm:w-[140px]">
                    <SelectValue placeholder="Filter Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Filter Type</SelectLabel>
                        <SelectItem v-for="option in filterOptions" :key="option" :value="option">
                            {{ option === 'month' ? 'Month' : 'All Goals' }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>

            <!-- Month Select (only if Month filter is active) -->
            <Select v-if="filterType === 'month'" v-model="selectedMonth">
                <SelectTrigger class="w-full sm:w-[130px]">
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

            <Select v-model="status">
                <SelectTrigger class="w-full sm:w-[140px]">
                    <SelectValue placeholder="Status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Status</SelectLabel>
                        <SelectItem v-for="opt in statusOptions" :key="opt" :value="opt">{{ opt }}</SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>

            <Input v-model="searchInput" type="text" placeholder="Search goals..." class="w-full" />
        </CardContent>
    </Card>
</template>
