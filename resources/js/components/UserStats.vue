<template>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div v-for="(count, role) in stats" :key="role" class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-all duration-300 border border-slate-200 dark:border-slate-700">
      <div class="flex items-center">
        <div class="p-3 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
          <svg v-if="role === 'manager'" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
          <svg v-if="role === 'revisor'" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
          <svg v-if="role === 'comprador'" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        </div>
        <div class="ml-4">
          <p class="text-4xl font-bold text-slate-800 dark:text-slate-100">{{ count }}</p>
          <h3 class="text-lg font-medium text-slate-500 dark:text-slate-400 capitalize">{{ role }}s</h3>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
  defineProps({ stats: { type: Object, required: true } });
</script>