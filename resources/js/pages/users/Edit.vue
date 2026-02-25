<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { index, edit, update } from '@/routes/users';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Rocket } from 'lucide-vue-next';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const page = usePage();

interface User {
    id: number,
    name: string,
    email: string,
    role: string,
}

const props = defineProps<{
    user: User,
    roleOptions: Array<string>,
}>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.users.title'),
        href: index().url,
    },
    {
        title: t('ui.users.edit_user'),
        href: edit(props.user).url,
    },
];

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
});

const handleSubmit = () => {
    form.patch(update(props.user).url)
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.users.edit_user')" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <Rocket class="h-4 w-4" />
                <AlertTitle>{{ t('ui.alert.title') }}</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>

            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="name">{{ t('forms.name') }}</Label>
                    <Input id="name" type="text" name="name" required autofocus autocomplete="user-name"
                        v-model="form.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="space-y-2">
                    <Label for="email">{{ t('forms.email') }}</Label>
                    <Input id="email" type="text" name="email" required autofocus autocomplete="user-email"
                        v-model="form.email" />
                    <InputError :message="form.errors.email" />
                </div>
                <div class="space-y-2">
                    <Label for="role">{{ t('forms.name') }}</Label>
                    <Select v-model="form.role" name="role" id="role">
                        <SelectTrigger>
                            <SelectValue placeholder="Select Role" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="option in roleOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.role" />
                </div>
                <Button type="submit" :disabled="form.processing">{{ t('buttons.user_update') }}</Button>
            </form>
        </div>
    </AppLayout>
</template>