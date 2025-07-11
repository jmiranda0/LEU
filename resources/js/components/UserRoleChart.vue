<template>
  <div class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-xl p-6 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 h-full flex flex-col">
    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mb-4 flex-shrink-0">Distribución por Rol</h3>
    
    <!-- CONTENEDOR CON ALTURA FIJA: Esta es la solución al bug -->
    <div class="relative h-80 w-full">
      <Bar :data="chartData" :options="chartOptions" />
    </div>
  </div>
</template>

<script setup>
  import { computed } from 'vue';
  import { Bar } from 'vue-chartjs';
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

  const props = defineProps({
    stats: {
      type: Object,
      required: true
    }
  });

  const chartData = computed(() => ({
    labels: Object.keys(props.stats).map(role => role.charAt(0).toUpperCase() + role.slice(1)),
    datasets: [
      {
        label: 'Nº de Usuarios',
        backgroundColor: ['#4F46E590', '#10B98190', '#F59E0B90'], // Colores con transparencia
        borderColor: ['#4F46E5', '#10B981', '#F59E0B'],
        borderWidth: 2,
        borderRadius: 6,
        data: Object.values(props.stats)
      }
    ]
  }));

  // Opciones de configuración. `maintainAspectRatio: false` es CRUCIAL aquí.
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false, // Permite que el gráfico llene el contenedor de altura fija.
    plugins: {
      legend: {
        display: false
      },
      tooltip: {
        backgroundColor: '#1E293B',
        titleFont: { size: 14, weight: 'bold' },
        bodyFont: { size: 12 },
        padding: 10,
        cornerRadius: 6,
        displayColors: false
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          color: '#334155'
        },
        ticks: {
          color: '#94A3B8',
          precision: 0
        }
      },
      x: {
        grid: {
          display: false
        },
        ticks: {
          color: '#94A3B8'
        }
      }
    }
  };
</script>