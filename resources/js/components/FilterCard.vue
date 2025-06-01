<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';

const search = ref('');
const selectedStatus = ref('');
const selectedSort = ref('');
</script>

<template>
    <Card class="w-full">
        <CardHeader class="pb-2">
            <CardTitle>Filter Settings</CardTitle>
        </CardHeader>
        <CardContent class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between sm:gap-6">
            <!-- Search -->
            <div class="flex flex-col gap-1 sm:w-1/3">
                <label class="text-muted-foreground text-sm">Search</label>
                <Input v-model="search" placeholder="Search goals or tasks..." />
            </div>

            <!-- Status Filter -->
            <div class="flex flex-col gap-1 sm:w-1/4"></div>

            <!-- Reset -->
            <div class="flex items-end">
                <Button
                    variant="outline"
                    class="w-full"
                    @click="
                        () => {
                            search = '';
                            selectedStatus = '';
                            selectedSort = '';
                        }
                    "
                >
                    Reset
                </Button>
            </div>
        </CardContent>
    </Card>
</template>
