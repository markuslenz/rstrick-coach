<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/appearance';
import { type BreadcrumbItem } from '@/types';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.appearance.page_title'),
        href: edit().url,
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="t('ui.appearance.page_title')" />

        <h1 class="sr-only">{{ t('ui.appearance.page_title') }}</h1>

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall
                    :title="t('ui.appearance.title')"
                    :description="t('ui.appearance.description')"
                />
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
