<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, edit, update } from '@/routes/tricks'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import InputError from '@/components/InputError.vue'
import { Button } from '@/components/ui/button'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Rocket } from 'lucide-vue-next'
import { Textarea } from '@/components/ui/textarea'
import { AlertCircleIcon } from 'lucide-vue-next'

const page = usePage();

interface Trick {
    id: number,
    name: string,
    level: string,
    youtube: string,
    judge_id: number,
    description: string,
    video: File | null,
}

const props = defineProps<{
    trick: Trick,
    levelOptions: Array<string>,
    judgeOptions: Array<string>,
}>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tricks',
        href: index().url,
    },
    {
        title: 'Edit Trick',
        href: '',
    },
];

const form = useForm({
    name: props.trick.name,
    level: props.trick.level,
    youtube: props.trick.youtube,
    judge_id: props.trick.judge_id,
    description: props.trick.description,
});

const handleSubmit = () => {
    form.patch(update(props.trick).url, {
        forceFormData: true,
    })
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Edit Trick" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <Rocket class="h-4 w-4" />
                <AlertTitle>Notification!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>

            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="name">Trick name</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="trick-name"
                        v-model="form.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="space-y-2">
                    <Label for="judge_id">Judge Type</Label>
                    <Select v-model="form.judge_id" name="judge_id" id="judge_id">
                        <SelectTrigger>
                            <SelectValue placeholder="Select Level" />
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
                    <Alert>
                        <AlertCircleIcon />
                        <AlertTitle>Notification</AlertTitle>
                        <AlertDescription>
                            <p>Please reference either a Youtube Video or upload a video.</p>
                        </AlertDescription>
                    </Alert>
                </div>
                <div class="space-y-2">
                    <Label for="youtube">Youtube URL</Label>
                    <Input id="youtube" type="text" name="youtube" required autocomplete="trick-youtube"
                        v-model="form.youtube" />
                    <InputError :message="form.errors.youtube" />
                </div>
                <div class="space-y-2">
                    <Label for="video">Neues Video (optional)</Label>
                    <Input id="video" type="file" accept="video/*" @change="form.video = $event.target.files[0]" />
                    <InputError :message="form.errors.video" />
                </div>
                <div class="space-y-2">
                    <Label for="description">Description</Label>
                    <Textarea id="description" type="text" name="description" v-model="form.description" />
                    <InputError :message="form.errors.description" />
                </div>
                <Button type="submit" :disabled="form.processing">Update Trick</Button>
            </form>
        </div>
    </AppLayout>
</template>