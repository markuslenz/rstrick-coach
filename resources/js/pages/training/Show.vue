<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'
import InputError from '@/components/InputError.vue'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { show, store } from '@/routes/trainings'
import { Spinner } from '@/components/ui/spinner'

const props = defineProps({ 
    trick: Object,
    tricks: Array,
    levelOptions: Array,
    judgeOptions: Array,
    judgeID: Number,
})


const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Training',
        href: '',
    },
];

const form = useForm({
    trick_id: props.trick.id,
    level: '',
    judge_id: '',
    trick_name: '',
    judgeID: props.judgeID,

})

const handleSubmit = () => {
    form.post(store().url)
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Training" />

        <div class="px-4 py-4">
            <div class="youtube-container" v-if="props.trick.youtube">
                <iframe
                    :src="props.trick.youtube + '?autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1'"
                    title="YouTube video player" 
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                >
                </iframe>
            </div>
            <div v-if="props.trick.video_url">
                <video controls width="100%" :src="'/storage/' + props.trick.video_url"></video>
            </div>
            <h1 class="mb-4 mt-4 text-2xl font-bold text-heading">Answer the following questions:</h1>
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <Input id="judgeID" type="hidden" name="judgeID" v-model="form.judgeID" />
                <Input id="trick_id" type="hidden" name="trick_id" v-model="form.trick_id" />
                <div class="space-y-2">
                    <Label for="judge_id">Which Judge eavluates this trick?</Label>
                    <Select v-model="form.judge_id" name="judge_id" id="judge_id">
                        <SelectTrigger>
                            <SelectValue placeholder="Select responsible Judge" />
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
                    <Label for="level">Which level is the trick?</Label>
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
                </div>
                <div class="space-y-2">
                    <Label for="trick_name">What's the trick called?</Label>
                    <RadioGroup v-model="form.trick_name" id="trick_name" name="trick_name">
                        <div class="flex items-center space-x-2" v-for="line in tricks" :key="line.id">
                            <RadioGroupItem :id="line.id" :value="line.name"/>
                            <Label :for="line.id">{{ line.name }}</Label>
                        </div>
                    </RadioGroup>
                    <InputError :message="form.errors.trick_name" />
                </div>
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    Submit
                </Button>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>
.youtube-container {
    overflow: hidden;
    width: 100%;
    /* Keep it the right aspect-ratio */
    aspect-ratio: 16/9;
    /* No clicking/hover effects */
    pointer-events: none;

    iframe {
        /* Extend it beyond the viewport... */
        width: 300%;
        height: 100%;
        /* ...and bring it back again */
        margin-left: -100%;
    }
}
</style>