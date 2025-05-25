<script setup lang="ts">
import GoalItem from '@/components/GoalItem.vue';
import { Goal } from '@/types';

const props = defineProps<{
    goals: Goal[];
}>();
</script>
<template>
    <div v-for="goal in props.goals" :key="goal.id" class="my-2">
        <GoalItem
            :id="goal.id"
            :title="goal.title"
            :description="goal.description"
            :deadline="goal.deadline"
            :status="goal.status"
            :tasks="goal.tasks"
        />
    </div>
</template>
