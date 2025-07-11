<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Muestra una lista paginada de usuarios.
     * Puede ser filtrada por el rol del usuario.
     * Endpoint: GET /api/users
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Validación: Nos aseguramos de que si se envía un 'role', sea uno de los válidos.
        $request->validate([
            'role' => [
                'sometimes', // El campo es opcional
                Rule::in(UserRoleEnum::getValues()), // Debe ser uno de los valores del Enum
            ],
        ]);
        // Consulta a la base de datos
        $usersQuery = User::query();
        // Filtro condicional: Si la URL incluye un 'role', aplicamos el filtro.
        $usersQuery->when($request->has('role'), function ($query) use ($request) {
            return $query->where('role', $request->query('role'));
        });
        // Paginación: Obtenemos los resultados paginados (15 por página por defecto).
        // Laravel automáticamente leerá el parámetro '?page' de la URL.
        $users = $usersQuery->latest()->paginate(15);
        // Respuesta: Devolvemos el objeto paginado como JSON.
        return response()->json($users);
    }

    /**
     * Devuelve las estadísticas con la cantidad de usuarios por rol.
     * Endpoint: GET /api/users/statistics
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics()
    {
        // Consulta eficiente: Le pedimos a la DB que cuente y agrupe por nosotros.
        $stats = User::query()
            ->select('role', DB::raw('count(*) as user_count'))
            ->groupBy('role')
            ->get()
            ->keyBy('role'); // Usamos keyBy para que el 'role' sea la clave (ej: 'manager' => [...])

        // Formateo de la respuesta: Nos aseguramos de que todos los roles
        // aparezcan en la respuesta, incluso si tienen 0 usuarios.
        $allRoles = UserRoleEnum::getValues();
        $formattedStats = [];

        foreach ($allRoles as $role) {
            // Si el rol existe en los resultados de la DB, tomamos su contador. Si no, es 0.
            $formattedStats[$role] = $stats->has($role) ? $stats[$role]->user_count : 0;
        }

        // 3. Respuesta: Devolvemos las estadísticas como JSON.
        return response()->json($formattedStats);
    }
}