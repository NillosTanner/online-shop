<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  shops: {
    type: Array
  }
})
</script>

<template>
  <Head title="Главная" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Главная</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-4 gap-y-8">
              <div v-for="shop in shops" :key="shop.id">
                <Link :href="route('shop', shop)" class="flex flex-col gap-2">
                  <div>
                    <img
                      class="w-full aspect-video rounded-xl"
                      :src="`https://img.freepik.com/premium-photo/electronics-store-display-with-arafed-view-generative-ai_561855-4443.jpg`"
                    />
                  </div>
                  <div class="font-bold text-lg truncate">
                    {{ shop.name }} ({{ shop.address }})
                  </div>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
