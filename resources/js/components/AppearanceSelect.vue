<script setup lang="ts">
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;
</script>

<template>
    <Select default-value="light" :model-value="appearance">
        <SelectTrigger>
            <SelectValue placeholder="Select Theme" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>Theme</SelectLabel>
                <SelectItem v-for="{ value, Icon, label } in tabs" :key="value" :value="value" @select="updateAppearance(value)">
                    <div class="flex items-center">
                        <component :is="Icon" class="-ml-1 h-4 w-4" />
                        <span class="ml-2">{{ label }}</span>
                    </div>
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
