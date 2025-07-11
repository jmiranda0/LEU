<template>
  <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
    <!-- VISTA DE ESCRITORIO (TABLA) -->
    <table class="hidden md:table min-w-full">
      <thead class="bg-slate-50 dark:bg-slate-900/50">
        <tr>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Correo</th>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Rol</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
        <tr v-if="users.data.length === 0"><td colspan="3" class="px-6 py-10 text-center text-slate-500">No se encontraron usuarios.</td></tr>
        <tr v-for="user in users.data" :key="user.id" class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">{{ user.name }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ user.email }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="{ 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300': user.role === 'manager', 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300': user.role === 'revisor', 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300': user.role === 'comprador' }">{{ user.role }}</span>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- VISTA MÓVIL (TARJETAS) -->
    <div class="md:hidden divide-y divide-slate-200 dark:divide-slate-700">
      <div v-if="users.data.length === 0" class="px-4 py-10 text-center text-slate-500">No se encontraron usuarios.</div>
      <div v-for="user in users.data" :key="`mobile-${user.id}`" class="p-4 space-y-2">
        <div class="flex justify-between items-center">
          <p class="font-bold text-slate-900 dark:text-slate-100">{{ user.name }}</p>
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="{ 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300': user.role === 'manager', 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300': user.role === 'revisor', 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300': user.role === 'comprador' }">{{ user.role }}</span>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400 break-all">{{ user.email }}</p>
      </div>
    </div>
    
    <div v-if="users.links && users.links.length > 3" class="bg-white/75 dark:bg-slate-800/75 backdrop-blur-sm px-4 py-3 flex items-center justify-between border-t border-slate-200 dark:border-slate-700 sm:px-6">
      <div class="flex-1 flex justify-between sm:hidden">
        <button @click="changePage(users.prev_page_url)" :disabled="!users.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 text-sm font-medium rounded-md text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50">Anterior</button>
        <button @click="changePage(users.next_page_url)" :disabled="!users.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 text-sm font-medium rounded-md text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50">Siguiente</button>
      </div>
      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div><p class="text-sm text-slate-700 dark:text-slate-400">Mostrando <span class="font-medium text-slate-900 dark:text-slate-200">{{ users.from }}</span> a <span class="font-medium text-slate-900 dark:text-slate-200">{{ users.to }}</span> de <span class="font-medium text-slate-900 dark:text-slate-200">{{ users.total }}</span></p></div>
        <div>
          <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <button v-for="(link, index) in users.links" :key="index" @click="changePage(link.url)" :disabled="!link.url" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-colors duration-200 disabled:opacity-50" :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 dark:bg-slate-700 dark:border-indigo-500 dark:text-white': link.active, 'bg-white border-slate-300 text-slate-500 hover:bg-slate-50 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700': !link.active, 'rounded-l-md': index === 0, 'rounded-r-md': index === users.links.length - 1 }" v-html="link.label"></button>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
    const props = defineProps({ users: { type: Object, required: true } });
    const emit = defineEmits(['page-change']);
    function changePage(url) { if (!url) return; emit('page-change', url); }
</script>