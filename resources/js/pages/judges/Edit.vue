<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, edit, update } from '@/routes/judges'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import InputError from '@/components/InputError.vue'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { Rocket } from 'lucide-vue-next'
import { Spinner } from '@/components/ui/spinner'

const page = usePage()

interface Judge{
    id: number,
    name: string,
}

const props = defineProps<{judge: Judge}>()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Judge Types',
        href: index().url,
    },
    {
        title: 'Edit Judge Type',
        href: edit(props.judge.id).url,
    }
]

const form = useForm({
    name: props.judge.name,
})

const handleSubmit = () => {
    form.patch(update(props.judge).url)
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Edit Judge Type" />

        <h1 class="sr-only">Maintain an existing Judge Type</h1>


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
                    <Label for="name">Judge Type name</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="judge-type-name" v-model="form.name"/>
                    <InputError :message="form.errors.name" />
                </div>
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    Update Judge Type
                </Button>
            </form>
        </div>
    </AppLayout>
</template>