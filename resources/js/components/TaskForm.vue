<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { cn } from '@/lib/utils';
import { Goal } from '@/types';
import { router } from '@inertiajs/vue3';
import { DateFormatter, getLocalTimeZone, parseDate, today } from '@internationalized/date';
import { toTypedSchema } from '@vee-validate/zod';
import { CalendarIcon } from 'lucide-vue-next';
import { toDate } from 'reka-ui/date';
import { useForm } from 'vee-validate';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';
import * as z from 'zod';

const formSchema = toTypedSchema(
    z.object({
        title: z.string().min(2).max(50),
        due_date: z.string(),
    }),
);

const { handleSubmit, setFieldValue, values, isFieldDirty, errors } = useForm({
    validationSchema: formSchema,
});

const df = new DateFormatter('en-US', {
    dateStyle: 'long',
});

const placeholder = ref();

const value = computed({
    get: () => (values.due_date ? parseDate(values.due_date) : undefined),
    set: (val) => val,
});

const props = defineProps<{
    goal: Goal | null;
}>();

const onSubmit = handleSubmit((values) => {
    console.log('Form submitted with values:', values);

    router.post(
        route('goal.task.store', props.goal?.id),
        {
            title: values.title,
            due_date: values.due_date,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                // Reset form
                setFieldValue('title', '');
                setFieldValue('due_date', '');
                toast.success('Task created successfully!', {
                    description: 'Your task has been created and is now being tracked.',
                });
                router.visit(route('goal.show', props.goal?.id), {
                    preserveState: true,
                });
            },
            onError: (error) => {
                toast.error('Error: ' + error.message, {
                    description: 'Please check the form and try again.',
                });
                console.error('Error creating task:', error);
            },
        },
    );
});
</script>
<template>
    <Card class="w-full shadow-lg">
        <CardHeader>
            <CardTitle class="text-lg font-semibold"> Create a New Task </CardTitle>
            <CardDescription>
                Create a task for your goal: <span class="font-semibold">{{ props.goal?.title }}</span>
            </CardDescription>
            <p class="text-muted-foreground text-sm">Tasks help you break down your goals into manageable steps.</p>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="onSubmit" class="space-y-6">
                <FormField v-slot="{ componentField }" name="title" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel class="gap-1"><span class="text-red-500">*</span> Title</FormLabel>
                        <FormControl>
                            <Input type="text" placeholder="Read a book on Vue.js" v-bind="componentField" />
                        </FormControl>
                        <FormDescription v-if="!errors.title" class="text-xs"> Set a title for your task. </FormDescription>
                        <FormMessage v-else class="text-xs" />
                    </FormItem>
                </FormField>

                <FormField name="due_date">
                    <FormItem class="flex flex-col">
                        <FormLabel class="gap-1"> <span class="text-red-500">*</span> Due date </FormLabel>
                        <Popover>
                            <PopoverTrigger as-child>
                                <FormControl>
                                    <Button
                                        variant="outline"
                                        :class="cn('font-norma cursor-pointer ps-3 text-start', !value && 'text-muted-foreground')"
                                    >
                                        <span>{{ value ? df.format(toDate(value)) : 'Select a date' }}</span>
                                        <CalendarIcon class="ms-auto h-4 w-4 opacity-50" />
                                    </Button>
                                    <input hidden />
                                </FormControl>
                            </PopoverTrigger>
                            <PopoverContent class="w-auto p-0">
                                <Calendar
                                    v-model:placeholder="placeholder"
                                    v-model="value"
                                    calendar-label="Due date"
                                    initial-focus
                                    :min-value="today(getLocalTimeZone())"
                                    :max-value="today(getLocalTimeZone()).add({ years: 1 })"
                                    @update:model-value="
                                        (v) => {
                                            if (v) {
                                                setFieldValue('due_date', v.toString());
                                            } else {
                                                setFieldValue('due_date', undefined);
                                            }
                                        }
                                    "
                                />
                            </PopoverContent>
                        </Popover>
                        <FormDescription v-if="!errors.due_date" class="text-xs"> Set a due date for your task. </FormDescription>
                        <FormMessage v-else class="text-xs" />
                    </FormItem>
                </FormField>
                <Button type="submit" class="mt-4 w-full"> Submit </Button>
            </form>
        </CardContent>
        <CardFooter>
            <p class="text-muted-foreground text-xs">Fields marked with <span class="text-red-500">*</span> are required.</p>
        </CardFooter>
    </Card>
</template>
