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
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { AlertCircleIcon } from 'lucide-vue-next'
import { Spinner } from '@/components/ui/spinner'
import { useI18n } from 'vue-i18n'
import { formatPostcssSourceMap } from 'vite'

const { t } = useI18n()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.tricks.title'),
        href: index().url,
    },
    {
        title: t('ui.tricks.create'),
        href: create().url,
    },
]

const form = useForm({
    name: '',
    level: '',
    youtube: '',
    video: '',
    judge_id: '',
    description: '',
})

const handleSubmit = () => {
    form.post(store().url,{
        forceFormData: true,
    })
}

defineProps({
    levelOptions: Array,
    judgeOptions: Array,
})

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.tricks.create')" />

        <div class="px-4 py-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="name">{{ t('forms.trick_name') }}</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="trick-name"
                        v-model="form.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="space-y-2">
                    <Label for="judge_id">{{ t('forms.judge')}}</Label>
                    <Select v-model="form.judge_id" name="judge_id" id="judge_id">
                        <SelectTrigger>
                            <SelectValue :placeholder="t('forms.judge_select')" />
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
                    <Label for="level">{{ t('forms.level') }}</Label>
                    <Select v-model="form.level" id="level" name="level">
                        <SelectTrigger>
                            <SelectValue :placeholder="t('forms.level_select')" />
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
                        <AlertTitle>{{ t('ui.tricks.alert.title') }}</AlertTitle>
                        <AlertDescription>
                            <p>{{ t('ui.tricks.alert.description') }}</p>
                        </AlertDescription>
                    </Alert>
                </div>
                <div class="space-y-2">
                    <Label for="youtube">{{ t('forms.youtube') }}</Label>
                    <Input id="youtube" type="text" name="youtube" autocomplete="trick-youtube"
                        v-model="form.youtube" />
                    <InputError :message="form.errors.youtube" />
                </div>
                <div class="space-y-2">
                    <Label for="video">{{ t('forms.video') }}</Label>
                    <Input id="video" type="file" accept="video/*" name="video" @change="form.video = $event.target.files[0]" />
                    <InputError :message="form.errors.video" />
                </div>
                <div class="space-y-2">
                    <Label for="description">{{ t('forms.description') }}</Label>
                    <Textarea id="description" type="text" name="description" v-model="form.description" placeholder="Enter a description here" />
                    <InputError :message="form.errors.description" />
                </div>
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    {{ t('buttons.save') }}
                </Button>
            </form>
        </div>
    </AppLayout>
</template>