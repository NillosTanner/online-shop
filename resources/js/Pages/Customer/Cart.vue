<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const form = useForm({
  product: {}
})

const removeProduct = (uuid) => {
  form.post(route('customer.cart.remove', uuid), { preserveScroll: true })
}

const order = useForm({})

const placeOrder = () => {
  order.post(route('customer.orders.store'))
}
</script>

<template>
  <Head title="Корзина" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Корзина</h2>
    </template>

    <div class="py-12">
      <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 overflow-x-scroll flex flex-col gap-6">
            <div
              v-for="product in $page.props.cart.items"
              :key="product.uuid"
              class="border-b pb-6"
            >
              <div class="flex gap-4">
                <div class="flex-none w-14">
                  <img
                    class="w-full aspect-square rounded"
                    :src="`https://img.freepik.com/premium-photo/modern-gadgets-background_295303-4829.jpg`"
                  />
                </div>
                <div class="flex flex-col">
                  <div>{{ product.name }}</div>
                  <div>{{ (product.price / 100).toFixed(2) }} &#8381;</div>
                </div>
                <div class="flex items-center ml-auto">
                  <button
                    type="button"
                    class="btn btn-secondary w-8 h-8 p-4"
                    @click="removeProduct(product.uuid)"
                  >
                    —
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
          <div class="p-6 text-gray-900 font-bold">
            <div class="flex items-center justify-between text-2xl border-b pb-4">
              <div>Общая сумма</div>
              <div>{{ ($page.props.cart.total / 100).toFixed(2) }} &#8381;</div>
            </div>
            <div class="mt-4" v-if="$page.props.cart.items.length">
              <PrimaryButton type="button" @click="placeOrder">Оформить заказ</PrimaryButton>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
