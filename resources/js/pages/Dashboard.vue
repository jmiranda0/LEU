<template>
  <div class="min-h-screen font-sans text-slate-800 dark:text-slate-200 bg-slate-100 dark:bg-slate-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      
      <!-- ===== ENCABEZADO ===== -->
      <header class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-6 mb-10 overflow-hidden">
        <!-- Efecto de "Glow" con gradiente -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-tr from-indigo-200 via-purple-200 to-pink-200 dark:from-indigo-900/50 dark:via-purple-900/50 dark:to-pink-900/50 rounded-full filter blur-3xl opacity-50"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center">
          <div class="flex items-center">
            <!-- Logo -->
            <Logo class="flex-shrink-0" />
            <div class="ml-4">
              <!-- Título actualizado -->
              <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Listado y Estadísticas de Usuarios
              </h1>
              <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Plataforma de análisis de datos</p>
            </div>
          </div>
          <!-- Botón de Tema -->
          <ThemeToggle :is-dark-mode="isDarkMode" @toggle="toggleTheme" class="mt-4 sm:mt-0 flex-shrink-0" />
        </div>
      </header>

      <main>
        <div v-if="isLoading" class="flex justify-center items-center h-64">
          <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        </div>
        
        <Transition
          enter-active-class="transition-all duration-700 ease-out"
          enter-from-class="opacity-0 translate-y-5"
          enter-to-class="opacity-100 translate-y-0"
        >
          <div v-if="!isLoading" class="space-y-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
              <div class="lg:col-span-1 bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 flex flex-col justify-center items-center text-center">
                <p class="text-lg font-medium text-slate-500 dark:text-slate-400">Total de Usuarios</p>
                <p class="text-6xl font-extrabold text-indigo-600 dark:text-indigo-400 my-2">{{ totalUsers }}</p>
                <p class="text-sm text-slate-400">Registrados en la plataforma</p>
              </div>
              
              <div class="lg:col-span-2">
                <UserRoleChart :stats="stats" />
              </div>
            </div>

            <div class="space-y-4">
             
              <div>
                <label for="role-filter" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Filtrar por Rol</label>
                <div class="relative mt-1">
                  <select id="role-filter" v-model="selectedRole" class="appearance-none block w-full sm:w-1/3 md:w-1/4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-200 rounded-md shadow-sm py-2 pl-3 pr-10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option value="">Todos los Roles</option>
                    <option value="manager">Manager</option>
                    <option value="revisor">Revisor</option>
                    <option value="comprador">Comprador</option>
                  </select>
                </div>
              </div>
              <UserList :users="users" @page-change="fetchUsers" />
            </div>
            
          </div>
        </Transition>
      </main>
        <footer class="relative mt-12 bg-white/50 dark:bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-6 overflow-hidden">
    <!-- Efecto de "Glow" con gradiente, idéntico al del header para consistencia -->
    <div class="absolute -top-1/2 left-1/2 -translate-x-1/2 w-96 h-96 bg-gradient-to-tr from-indigo-200 via-purple-200 to-pink-200 dark:from-indigo-900/50 dark:via-purple-900/50 rounded-full filter blur-3xl opacity-50"></div>

    
    <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
      
      
      <div class="text-center sm:text-left text-sm text-slate-500 dark:text-slate-400">
        <p>© {{ currentYear }} Jahzeel Miranda Pérez. Todos los derechos reservados.</p>
        <p class="mt-1">Diseñado para la prueba técnica con Laravel y Vue.js 3.</p>
      </div>

      
      <div class="flex flex-col items-center sm:items-end space-y-2">
        <!-- Enlace de Correo Electrónico -->
        <a 
          href="mailto:jahzeelmiranda0@gmail.com" 
          class="flex items-center text-sm text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300 group"
        >
          <!-- Ícono de Correo -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors" viewBox="0 0 20 20" fill="currentColor">
            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
          </svg>
          <span class="mr-2">jahzeelmiranda0@gmail.com</span>
        </a>

        <!-- Enlace de WhatsApp -->
        <a 
          href="https://wa.me/1234567890" 
          target="_blank" 
          rel="noopener noreferrer"
          class="flex items-center text-sm text-slate-600 dark:text-slate-300 hover:text-green-600 dark:hover:text-green-400 transition-colors duration-300 group"
        >
          <!-- Ícono de "WhatsApp" -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 dark:text-slate-500 group-hover:text-green-500 dark:group-hover:text-green-400 transition-colors" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.839 8.839 0 01-4.43-1.252L1.22 19.53a.5.5 0 01-.624-.625l1.758-4.33A8.963 8.963 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7zm-2.062-3.46a.5.5 0 00-.707-.708L12.5 8.56V6.5a.5.5 0 00-1 0v2.5a.5.5 0 00.146.354l2.5 2.5a.5.5 0 00.708-.708L12.707 9.5l3.23-3.23z" clip-rule="evenodd" />
          </svg>
          <span class="mr-2">+53 54899006</span>
        </a>
      </div>

    </div>
  </footer>
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted, watch, computed } from 'vue';
  import axios from 'axios';
  import Logo from '@/Components/Logo.vue'; // Importamos el logo
  import UserRoleChart from '@/Components/UserRoleChart.vue';
  import UserList from '@/Components/UserList.vue';
  import ThemeToggle from '@/Components/ThemeToggle.vue';

  const isDarkMode = ref(false);
  const setInitialTheme = () => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
      isDarkMode.value = true;
    } else {
      document.documentElement.classList.remove('dark');
      isDarkMode.value = false;
    }
  };
  const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;
    localStorage.theme = isDarkMode.value ? 'dark' : 'light';
    document.documentElement.classList.toggle('dark', isDarkMode.value);
  };

  const users = ref({ data: [], links: [] });
  const stats = ref({});
  const selectedRole = ref('');
  const isLoading = ref(true);

  const totalUsers = computed(() => Object.values(stats.value).reduce((sum, count) => sum + count, 0));

  const fetchUsers = async (url = '/api/users') => {
    try {
      const params = selectedRole.value ? { role: selectedRole.value } : {};
      const response = await axios.get(url, { params });
      users.value = response.data;
    } catch (error) { console.error('Error al obtener los usuarios:', error); }
  };

  const fetchStats = async () => {
    try {
      const response = await axios.get('/api/users/statistics');
      stats.value = response.data;
    } catch (error) { console.error('Error al obtener las estadísticas:', error); }
  };

  onMounted(async () => {
    setInitialTheme();
    await Promise.all([fetchUsers(), fetchStats(), new Promise(res => setTimeout(res, 300))]);
    isLoading.value = false;
  });

  watch(selectedRole, () => { fetchUsers('/api/users'); });
</script>