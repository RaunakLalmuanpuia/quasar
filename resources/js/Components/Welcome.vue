<script setup>
import { ref } from "vue";

const basic = ref(false);
const fixed = ref(false);



const slide = ref('style')
const lorem = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque voluptatem totam, architecto cupiditate officia rerum, error dignissimos praesentium libero ab nemo.'
</script>

<template>
    <div>
            <div class="mb-4">
                <q-btn label="Open Modal" color="primary" @click="fixed = true" />
                <q-dialog v-model="fixed">
                    <q-card>
                        <q-card-section>
                        <div class="text-h6">Verify Report</div>
                        </q-card-section>

                        <q-separator />

                        <q-card-section style="max-height: 50vh" class="scroll">
                        <p v-for="n in 5" :key="n">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum repellendus sit voluptate voluptas eveniet porro. Rerum blanditiis perferendis totam, ea at omnis vel numquam exercitationem aut, natus minima, porro labore.</p>
                        </q-card-section>

                        <q-separator />

                        <q-card-actions align="right">
                        <q-btn flat label="Cancel" color="primary" v-close-popup />
                        <q-btn flat label="Submit" color="primary" v-close-popup />
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </div> 
        
            


        
                    <!-- carousel -->
                    <q-carousel
                        v-model="slide"
                        transition-prev="scale"
                        transition-next="scale"
                        swipeable
                        animated
                        control-color="white"
                        navigation
                        padding
                        arrows
                        height="300px"
                        class="bg-primary text-white shadow-1 rounded-borders"
                    >
                        <q-carousel-slide name="style" class="column no-wrap flex-center">
                        <q-icon name="style" size="56px" />
                        <div class="q-mt-md text-center">
                            {{ lorem }}
                        </div>
                        </q-carousel-slide>
                        <q-carousel-slide name="tv" class="column no-wrap flex-center">
                        <q-icon name="live_tv" size="56px" />
                        <div class="q-mt-md text-center">
                            {{ lorem }}
                        </div>
                        </q-carousel-slide>
                        <q-carousel-slide name="layers" class="column no-wrap flex-center">
                        <q-icon name="layers" size="56px" />
                        <div class="q-mt-md text-center">
                            {{ lorem }}
                        </div>
                        </q-carousel-slide>
                        <q-carousel-slide name="map" class="column no-wrap flex-center">
                        <q-icon name="terrain" size="56px" />
                        <div class="q-mt-md text-center">
                            {{ lorem }}
                        </div>
                        </q-carousel-slide>
                    </q-carousel>
       
    </div>
</template>
