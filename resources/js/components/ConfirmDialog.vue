<script setup lang="ts">
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button, buttonVariants } from '@/components/ui/button';
import { LucideIcon, Trash2 } from 'lucide-vue-next';

const props = defineProps<{
    type: 'task' | 'goal';
    title: string;
    description: string;
    modelTitle?: string;
    icon?: LucideIcon;
}>();

const emit = defineEmits<{
    (e: 'confirm'): void;
}>();

function handleConfirm(e: Event) {
    emit('confirm');
}
</script>
<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <Button v-if="!props.icon" size="sm" variant="destructive" @click.stop.prevent> <Trash2 class="h-4 w-4" /> {{ props.title }} </Button>
            <Button v-else size="icon" variant="destructive" @click.stop.prevent>
                <component :is="props.icon || Trash2" class="h-4 w-4" />
            </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>{{ props.description }}</AlertDialogTitle>
                <AlertDialogDescription>
                    <span class="font-bold">This action cannot be undone.</span><br />
                    This will permanently delete your {{ props.type === 'goal' ? 'goal and all its tasks' : 'task' }}.<br />
                    <br />
                    <p>
                        The following item will be deleted: <span class="text-destructive font-bold"> {{ props.modelTitle || 'Unknown error' }}</span>
                    </p>
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
                <AlertDialogAction @click="handleConfirm" :class="buttonVariants({ variant: 'destructive' })"> Delete </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
