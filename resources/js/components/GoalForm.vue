<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { useInertiaRouter } from '@/composables/useInertiaRouter';
import { cn } from '@/lib/utils';
import { DateFormatter, getLocalTimeZone, parseDate, today } from '@internationalized/date';
import { toTypedSchema } from '@vee-validate/zod';
import { CalendarIcon } from 'lucide-vue-next';
import { toDate } from 'reka-ui/date';
import { useForm } from 'vee-validate';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';
import * as z from 'zod';
import { Textarea } from './ui/textarea';

const inertia = useInertiaRouter();
const formSchema = toTypedSchema(
    z.object({
        title: z.string().min(2).max(50),
        description: z.string().max(500).optional(),
        deadline: z.string(),
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
    get: () => (values.deadline ? parseDate(values.deadline) : undefined),
    set: (val) => val,
});

const onSubmit = handleSubmit((values) => {
    console.log('Form submitted with values:', values);

    inertia.post(
        route('goal.store'),
        {
            title: values.title,
            description: values.description,
            deadline: values.deadline,
        },
        {
            onSuccess: () => {
                // Reset form
                setFieldValue('title', '');
                setFieldValue('description', '');
                setFieldValue('deadline', '');
                toast.success('Goal created successfully!', {
                    description: 'Your goal has been created and is now being tracked.',
                });
            },
            onError: (error: any) => {
                console.error('Error creating goal:', error);
                toast.error('Error: ' + error.message, {
                    description: 'Please check the form and try again.',
                });
            },
        },
    );
});
</script>
<template>
    <Card class="w-full shadow-lg">
        <CardHeader>
            <CardTitle class="text-lg font-semibold">Create a New Goal</CardTitle>
            <CardDescription> Set your new goal and start tracking your progress. </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="onSubmit" class="space-y-6">
                <FormField v-slot="{ componentField }" name="title" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel class="gap-1"><span class="text-red-500">*</span> Title</FormLabel>
                        <FormControl>
                            <Input type="text" placeholder="Learn Laravel and Vue.js" v-bind="componentField" />
                        </FormControl>
                        <FormDescription v-if="!errors.title" class="text-xs"> Set a title for your goal.</FormDescription>
                        <FormMessage v-else class="text-xs" />
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="description">
                    <FormItem>
                        <FormLabel>Description</FormLabel>
                        <FormControl>
                            <Textarea
                                placeholder="My goal is to learn how to code in Laravel and Vue.js by the end of the year."
                                class="resize-none"
                                v-bind="componentField"
                            />
                        </FormControl>
                        <FormDescription class="text-xs">
                            Set a description for your goal. <span class="text-xs font-bold">Optional</span></FormDescription
                        >
                        <FormMessage />
                    </FormItem>
                </FormField>

                <FormField name="deadline">
                    <FormItem class="flex flex-col">
                        <FormLabel class="gap-1"> <span class="text-red-500">*</span> Deadline </FormLabel>
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
                                    calendar-label="Deadline"
                                    initial-focus
                                    :min-value="today(getLocalTimeZone())"
                                    :max-value="today(getLocalTimeZone()).add({ years: 1 })"
                                    @update:model-value="
                                        (v) => {
                                            if (v) {
                                                setFieldValue('deadline', v.toString());
                                            } else {
                                                setFieldValue('deadline', undefined);
                                            }
                                        }
                                    "
                                />
                            </PopoverContent>
                        </Popover>
                        <FormDescription v-if="!errors.deadline" class="text-xs"> Set a deadline for your goal.</FormDescription>
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
