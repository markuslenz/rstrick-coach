<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, create, store } from '@/routes/judges'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import InputError from '@/components/InputError.vue'
import { Button } from '@/components/ui/button'
import { Spinner } from '@/components/ui/spinner'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.judges.title'),
        href: index().url,
    },
    {
        title: t('ui.judges.create'),
        href: create().url,
    },
]

const form = useForm({
    name: '',
})

const handleSubmit = () => {
    form.post(store().url)
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.judges.create')" />

        <div class="px-4 py-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="name">{{ t('forms.judge_name') }}</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="judge-type-name" v-model="form.name"/>
                    <InputError :message="form.errors.name" />
                </div>
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    {{ t('buttons.save') }}
                </Button>
            </form>
        </div>
    </AppLayout>
</template>