<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';

import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { type BreadcrumbItem } from '@/types';
import { useI18n } from 'vue-i18n'
import { formatPostcssSourceMap } from 'vite';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'

const { t } = useI18n()

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.profile.page_title'),
        href: edit().url,
    },
];

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.profile.page_title')" />

        <h1 class="sr-only">{{ t('ui.profile.page_title') }}</h1>

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall :title="t('ui.profile.title')" :description="t('ui.profile.description')" />

                <Form v-bind="ProfileController.update.form()" class="space-y-6"
                    v-slot="{ errors, processing, recentlySuccessful }">
                    <div class="grid gap-2">
                        <Label for="name">{{ t('forms.name') }}</Label>
                        <Input id="name" class="mt-1 block w-full" name="name" :default-value="user.name" required
                            autocomplete="name" :placeholder="t('forms.name_placeholder')" />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">{{ t('forms.email') }}</Label>
                        <Input id="email" type="email" class="mt-1 block w-full" name="email"
                            :default-value="user.email" required autocomplete="username"
                            :placeholder="t('forms.email')" />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="locale">{{ t('forms.locale') }}</Label>
                        <Select name="locale" id="locale" :defaultValue="user.locale">
                            <SelectTrigger>
                                <SelectValue :placeholder="t('forms.locale_placeholder')" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem v-for="l in page.props.locales" :key="l" :value="l">
                                    {{ t('ui.locales.' + l) }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError :message="errors.locale" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-sm text-muted-foreground">
                            {{ t('ui.profile.unverified') }}
                            <Link :href="send()" as="button"
                                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500">
                                {{ t('ui.profile.resend') }}
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
                            {{ t('ui.profile.verification') }}
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="processing" data-test="update-profile-button">{{ t('buttons.save')
                            }}</Button>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-show="recentlySuccessful" class="text-sm text-neutral-600">
                                {{ t('forms.saved') }}
                            </p>
                        </Transition>
                    </div>
                </Form>
            </div>

            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>
