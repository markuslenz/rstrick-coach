<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

// aktuelle Sprache vom Backend (optional, falls du sie mitsendest)
const page = usePage()

const currentLocale = computed(() => page.props.locale ?? 'de')

function changeLocale(locale) {
    if (locale === currentLocale.value) return

    router.post('/locale', { locale }, {
        preserveScroll: true,
        preserveState: true,
    })
}
</script>

<template>
    <div class="flex items-center justify-center gap-2">

        <Link @click.prevent="changeLocale('de')"
              class="cursor-pointer"
              :class="{ 'opacity-50': currentLocale === 'de' }">
            <span class="fi fi-de"></span>
        </Link>

        <Link @click.prevent="changeLocale('en')"
              class="cursor-pointer"
              :class="{ 'opacity-50': currentLocale === 'en' }">
            <span class="fi fi-gb"></span>
        </Link>

    </div>
</template>