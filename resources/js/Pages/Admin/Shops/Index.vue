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
  <Head title="Shops" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Магазины</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <Link
              class="btn btn-primary"
              v-if="can('shop.create')"
              :href="route('admin.shops.create')"
            >
              Добавить магазин
            </Link>
          </div>
          <div class="p-6 text-gray-900 overflow-x-scroll">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Город</th>
                  <th>Адрес</th>
                  <th>Имя Владельца</th>
                  <th>Email Владельца</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="shop in shops" :key="shop.id">
                  <td>{{ shop.id }}</td>
                  <td>{{ shop.name }}</td>
                  <td>
                    <div class="badge badge-primary">{{ shop.city.name }}</div>
                  </td>
                  <td>{{ shop.address }}</td>
                  <td>{{ shop.owner.name }}</td>
                  <td>
                    <a :href="'mailto:' + shop.owner.email" class="text-link">{{
                      shop.owner.email
                    }}</a>
                  </td>
                  <td>
                    <Link
                      v-if="can('shop.update')"
                      :href="route('admin.shops.edit', shop)"
                      class="btn btn-secondary"
                    >
                      Редактировать
                    </Link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
