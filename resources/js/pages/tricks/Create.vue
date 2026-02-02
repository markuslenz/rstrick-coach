<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, create, store } from '@/routes/tricks'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import InputError from '@/components/InputError.vue'
import { Button } from '@/components/ui/button'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tricks',
        href: index().url,
    },
    {
        title: 'Create Trick',
        href: create().url,
    },
]

const form = useForm({
    name: '',
    level: '',
    url: '',
    judge_id: '',
    description: '',
})

const handleSubmit = () => {
    form.post(store().url)
}

defineProps({
    levelOptions: Array,
    judgeOptions: Array,
})

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Create Trick" />

        <div class="px-4 py-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="name">Trick name</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="trick-name"
                        v-model="form.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="space-y-2">
                    <Label for="url">Video URL</Label>
                    <Input id="url" type="text" name="url" required autocomplete="trick-url"
                        v-model="form.url" />
                    <InputError :message="form.errors.url" />
                </div>
                <div class="space-y-2">
                    <Label for="judge_id">Judge Type</Label>
                    <Select v-model="form.judge_id" name="judge_id" id="judge_id">
                        <SelectTrigger>
                            <SelectValue placeholder="Select Judge Type" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="judge in judgeOptions" :key="judge.id" :value="judge.id">
                                {{ judge.name }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.judge_id" />
                </div>
                <div class="space-y-2">
                    <Label for="level">Level</Label>
                    <Select v-model="form.level" id="level" name="level">
                        <SelectTrigger>
                            <SelectValue placeholder="Select Level" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="option in levelOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.level" />
                </div>
                <div class="space-y-2">
                    <Label for="description">Description</Label>
                    <Textarea id="description" type="text" name="description" v-model="form.description" placeholder="Enter a description here" />
                    <InputError :message="form.errors.description" />
                </div>
                <Button type="submit" :disabled="form.processing">Add Trick</Button>
            </form>
        </div>
    </AppLayout>
</template>