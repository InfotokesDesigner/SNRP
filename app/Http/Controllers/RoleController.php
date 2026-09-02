<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Lista os perfis de acesso.
     */
    public function index()
    {
        $roles = Role::withCount('users')
            ->orderBy('nome')
            ->paginate(10);

        return view('perfis.index', compact('roles'));
    }

    /**
     * Formulário para criar um novo perfil.
     */
    public function create()
    {
        $permissions = Permission::where('ativo', true)
            ->orderBy('modulo')
            ->orderBy('nome')
            ->get()
            ->groupBy('modulo');

        return view('perfis.create', compact('permissions'));
    }

    /**
     * Guarda um novo perfil e as respectivas permissões.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:50',
                'unique:roles,nome',
            ],
            'descricao' => [
                'nullable',
                'string',
            ],
            'ativo' => [
                'nullable',
                'boolean',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        DB::transaction(function () use ($validated, $request) {

            $role = Role::create([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'ativo' => $request->boolean('ativo'),
            ]);

            $role->permissions()->sync(
                $validated['permissions'] ?? []
            );
        });

        return redirect()
            ->route('perfis.index')
            ->with('success', 'Perfil criado com sucesso.');
    }

    /**
     * Mostra os detalhes de um perfil.
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        return view('perfis.show', compact('role'));
    }

    /**
     * Formulário para editar um perfil.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('ativo', true)
            ->orderBy('modulo')
            ->orderBy('nome')
            ->get()
            ->groupBy('modulo');

        $role->load('permissions');

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('perfis.edit', compact(
            'role',
            'permissions',
            'selectedPermissions'
        ));
    }

    /**
     * Atualiza o perfil e as respectivas permissões.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:50',
                'unique:roles,nome,' . $role->id,
            ],
            'descricao' => [
                'nullable',
                'string',
            ],
            'ativo' => [
                'nullable',
                'boolean',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        DB::transaction(function () use ($validated, $request, $role) {

            $role->update([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'ativo' => $request->boolean('ativo'),
            ]);

            $role->permissions()->sync(
                $validated['permissions'] ?? []
            );
        });

        return redirect()
            ->route('perfis.index')
            ->with('success', 'Perfil atualizado com sucesso.');
    }

    /**
     * Remove um perfil.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()
                ->route('perfis.index')
                ->with(
                    'error',
                    'Não é possível eliminar este perfil porque existem utilizadores associados.'
                );
        }

        $role->permissions()->detach();
        $role->delete();

        return redirect()
            ->route('perfis.index')
            ->with('success', 'Perfil eliminado com sucesso.');
    }
}