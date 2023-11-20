<template>
    <QuasarLayout>
        <div class="q-pa-md" style="max-width: 400px">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
                <q-input
                    filled
                    v-model="form.filename"
                    label="File Name *"
                    hint="Name of file"
                    lazy-rules
                    :rules="[
                        (val) =>
                            (val && val.length > 0) || 'Please type something',
                    ]"
                />
                <q-select
                    rounded
                    outlined
                    v-model="form.employer"
                    :options="options"
                    label="Employer"
                />
                <div>
                    <q-btn label="Submit" type="submit" color="primary" />
                    <q-btn
                        label="Reset"
                        type="reset"
                        color="primary"
                        flat
                        class="q-ml-sm"
                    />
                </div>
            </q-form>
        </div>
    </QuasarLayout>
</template>
<script setup>
import QuasarLayout from "@/Layouts/QuasarLayout.vue";

import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    employer: Object,
});

const form = useForm({
    filename: "",
    filepath: "",
    employer: null,
});

// Compute options based on employer properties
const options = ref([]);

watch(
    () => props.employer,
    () => {
        // Update options whenever employer prop changes
        options.value = Object.entries(props.employer).map(([id, name]) => ({
            label: name,
            value: id,
        }));
    },
    { immediate: true }
);

const onSubmit = () => {
    form.post(route("report.store"));
};

const onReset = () => {
    form.filename = "";
    form.filepath = "";
    form.employer = "";
};
</script>
