<script setup lang="ts">
import { Form, Head, usePage } from '@inertiajs/vue3'

import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Spinner } from '@/components/ui/spinner'
import AuthBase from '@/layouts/AuthLayout.vue'
import { login } from '@/routes'
import { store } from '@/routes/register'
import { useI18n } from 'vue-i18n'

const page = usePage()

const { t } = useI18n()
</script>

<template>
    <AuthBase
        :title="t('ui.register.title')"
        :description="t('ui.register.description')"
    >
        <Head :title="t('ui.register.page_title')" />

        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">{{ t('forms.name') }}</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        name="name"
                        :placeholder="t('forms.name_placeholder')"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">{{ t('forms.email') }}</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="locale">{{ t('forms.locale') }}</Label>
                    <Select name="locale" id="locale">
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

                <div class="grid gap-2">
                    <Label for="password">{{ t('forms.password') }}</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        :placeholder="t('forms.password')"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ t('forms.password_confirm') }}</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        :placeholder="t('forms.password_confirm')"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full"
                    tabindex="5"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <Spinner v-if="processing" />
                    {{ t('buttons.account_create')}}
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                {{ t('ui.register.already_registered') }}
                <TextLink
                    :href="login()"
                    class="underline underline-offset-4"
                    :tabindex="6"
                    >{{ t('buttons.login') }}</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
