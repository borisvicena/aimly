<script setup lang="ts">
import GoalItem from '@/components/GoalItem.vue';
import { Goal } from '@/types';
import { MessageSquareWarning } from 'lucide-vue-next';

const props = defineProps<{
    goals: Goal[];
}>();
</script>
<template>
    <div v-if="goals" class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <GoalItem v-for="goal in goals" :goal="goal" :key="goal.id" />
    </div>
    <div v-if="!goals || goals.length === 0" class="mt-8 flex aspect-video flex-col items-center justify-center space-y-2 text-center text-gray-400">
        <MessageSquareWarning class="h-10 w-10" />
        <p class="text-md flex flex-col items-center justify-center">
            <span class="text-lg font-bold">No goals found</span>
            It looks like you haven't created any goals yet.<br />Start by adding a new goal or adjust your filter options to see more results.
        </p>
    </div>
</template>
