<template>
    <QuasarLayout>
      <div class="py-2 bg-white sm:py-10">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
          <div class="max-w-2xl mx-auto lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
              Pending Files
            </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
              Learn how to grow your business with our expert advice.
            </p>
          </div>
          <div
            class="grid max-w-2xl grid-cols-1 pt-5 mx-auto mt-5 border-t border-gray-200 gap-x-8 gap-y-16 sm:mt-6 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3"
          >
            <div
              v-for="report in employerPendingFiles"
              :key="report.id"
              class="flex flex-col items-start justify-between max-w-xl"
            >
              <template v-if="$page.props.auth.user.id === report.employer_id">
                <div class="flex items-center text-xs gap-x-4">
                  <time :datetime="report.created_at" class="text-gray-500">
                    {{ report.created_at }}
                  </time>
                  <button
                    @click="openModal(report)"
                    class="relative z-10 rounded-full bg-indigo-200 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
                  >
                    Verify
                  </button>
                </div>
                <div class="relative group">
                  <h3
                    class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600"
                  >
                    <a
                      :href="route('report.show', report.id)"
                      target="_blank"
                    >
                      <span class="absolute inset-0" />
                      Filename: {{ report.name }}
                    </a>
                  </h3>
                </div>
                <div class="relative flex items-center mt-8 gap-x-4">
                  <div class="text-sm leading-6">
                    <p class="font-semibold text-gray-900">
                      <span class="absolute inset-0" />
                      Employee Name: {{ report.employee_name }}
                    </p>
                  </div>
                </div>
              </template>
              <template v-else>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                  No Pending Files
                </p>
              </template>
            </div>
          </div>
        </div>
      </div>
    </QuasarLayout>
  </template>
  
  <script setup>
  import QuasarLayout from "@/Layouts/QuasarLayout.vue";
  
  const props = defineProps({
    employerPendingFiles: Array,
  });
  </script>
  