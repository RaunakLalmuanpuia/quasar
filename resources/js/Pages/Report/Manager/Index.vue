<template>
    <QuasarLayout>
        <main class="container mx-auto p-4 w-full">
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
            >
                <div
                    class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"
                >
                    <div
                        v-for="file in managerPendingFiles.data"
                        :key="file.id"
                    >
                        <div class="border border-gray-300 p-4 rounded-md mb-4">
                            <Link
                                v-if="file.id"
                                :href="route('report.show', file.id)"
                            >
                                <div class="flex flex-col items-start gap-2">
                                    <span class="font-bold">{{
                                        file.name
                                    }}</span>
                                    <span>{{ file.employee.name }}</span>
                                    <span>{{ file.employer.name }}</span>
                                    <span class="font-bold">{{
                                        file.employer_status
                                    }}</span>
                                    <span>{{ file.movement }}</span>
                                    <span>{{ file.employer_feedback }}</span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <div class="flex gap-1">
                    <Link
                        v-for="(link, index) in managerPendingFiles.links"
                        :key="index"
                        class="py-2 px-4 rounded-md"
                        :href="link.url || ''"
                        :class="{
                            'bg-indigo-500 dark:bg-indigo-800 text-gray-300':
                                link.active,
                        }"
                        v-html="link.label"
                    />
                </div>
            </div>
        </main>
    </QuasarLayout>
</template>

<script setup>
import QuasarLayout from "@/Layouts/QuasarLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    managerPendingFiles: Object,
});
</script>
<!-- <template>
  <QuasarLayout>
      <main class="container mx-auto p-4 w-full">
          <div
              class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
          >
              <div
                  class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"
              >
                  <div
                      v-for="file in managerPendingFiles.data"
                      :key="file.id"
                  >
                      <Link v-if="file.id" :href="route('dashboard')">
                          <div class="flex items-center gap-1">
                              <span class="font-bold">{{ file.name }}</span>
                              <span>{{ file.employee.name }}</span>
                              <span>{{ file.employer.name }}</span>
                              <span class="font-bold">{{
                                  file.employer_status
                              }}</span>
                              <span>{{ file.movement }}</span>
                              <span>{{ file.employer_feedback }}</span>
                          </div>
                      </Link>
                  </div>
                
              </div>
          </div>
          <div class="flex gap-1 mt-4">
              <Link
                  v-for="(link, index) in managerPendingFiles.links"
                  :key="index"
                  class="py-2 px-4 rounded-md"
                  :href="link.url || ''"
                  :class="{
                      'bg-indigo-500 dark:bg-indigo-800 text-gray-300':
                          link.active,
                  }"
                  v-html="link.label"
              />
          </div>
      </main>
  </QuasarLayout>
</template> -->
<!-- Use v-if to conditionally render Link -->
<!-- v-if=" managerPendingFiles.links && managerPendingFiles.links.length > 0
        " -->
<!-- <div v-if="managerPendingFiles.length > 0">
            {{ managerPendingFiles.length }}
            <div v-for="file in managerPendingFiles" :key="file.id">
                <p>{{ file.employee.name }}</p>
                <p>{{ file.employer.name }}</p>
            </div>
        </div>
        <div v-else>
            <p>No Pending Files</p>
        </div> -->
