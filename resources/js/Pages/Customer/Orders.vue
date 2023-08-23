<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  orders: {
    type: Array
  }
})
</script>

<template>
  <Head title="Мои заказы" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Мои заказы</h2>
    </template>

    <div class="py-12">
      <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 overflow-x-scroll flex flex-col gap-8">
            <div v-for="order in orders" :key="order.id">
              <div class="flex items-center justify-between text-2xl font-bold">
                <div>Заказ #{{ order.id }}</div>
                <div>{{ (order.total / 100).toFixed(2) }} &#8381;</div>
              </div>

              <div class="text-lg mb-6">{{ order.shop.name }}</div>

              <div
                v-for="product in order.products"
                :key="product.id"
                class="flex items-center justify-between border-b mb-2 pb-2"
              >
                <div>{{ product.name }}</div>
                <div>{{ (product.price / 100).toFixed(2) }} &#8381;</div>
              </div>
              <div class="text-gray-500">
                {{ new Date(order.created_at).toLocaleDateString() }}
                {{ order.status }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
