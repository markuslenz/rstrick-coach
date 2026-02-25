<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';

import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';
import { send } from '@/routes/verification';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        :title="t('ui.verify_email.title')"
        :description="t('ui.verify_email.description')"
    >
        <Head :title="t('ui.verify_email.page_title')" />

        <div
            v-if="status === 'verification-link-sent'"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ t('ui.verify_email.hint') }}
        </div>

        <Form
            v-bind="send.form()"
            class="space-y-6 text-center"
            v-slot="{ processing }"
        >
            <Button :disabled="processing" variant="secondary">
                <Spinner v-if="processing" />
                {{ t('buttons.resend_link')}}
            </Button>

            <TextLink
                :href="logout()"
                as="button"
                class="mx-auto block text-sm"
            >
                {{ t('buttons.logout') }}
            </TextLink>
        </Form>
    </AuthLayout>
</template>
