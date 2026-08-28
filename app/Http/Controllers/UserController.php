<?php
namespace App\Http\Controllers;
use App\Models\Instituicao;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    /**
     * Lista os utilizadores.
     */
    public function index()
    {
        $utilizadores = User::with(['role', 'instituicao'])
            ->orderBy('name')
            ->paginate(10);

        return view('utilizadores.index', compact('utilizadores'));
    }

    /**
     * Formulário para criar utilizador.
     */
    public function create()
    {
        $roles = Role::where('ativo', true)
            ->orderBy('nome')
            ->get();

        $instituicoes = Instituicao::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('utilizadores.create', compact(
            'roles',
            'instituicoes'
        ));
    }

    /**
     * Guarda um novo utilizador.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'instituicao_id' => [
                'nullable',
                'exists:instituicoes,id',
            ],

            'ativo' => [
                'nullable',
                'boolean',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'instituicao_id' => $validated['instituicao_id'] ?? null,
            'ativo' => $request->boolean('ativo', true),
        ]);

        return redirect()
            ->route('utilizadores.index')
            ->with('success', 'Utilizador criado com sucesso.');
    }

    /**
     * Mostra os dados de um utilizador.
     */
    public function show(User $utilizador)
    {
        $utilizador->load(['role', 'instituicao']);

        return view('utilizadores.show', compact('utilizador'));
    }

    /**
     * Formulário para editar utilizador.
     */
    public function edit(User $utilizador)
    {
        $roles = Role::where('ativo', true)
            ->orderBy('nome')
            ->get();

        $instituicoes = Instituicao::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('utilizadores.edit', compact(
            'utilizador',
            'roles',
            'instituicoes'
        ));
    }

    /**
     * Atualiza um utilizador.
     */
    public function update(Request $request, User $utilizador)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $utilizador->id,
            ],

            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'instituicao_id' => [
                'nullable',
                'exists:instituicoes,id',
            ],

            'ativo' => [
                'nullable',
                'boolean',
            ],
        ]);

        $dados = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'instituicao_id' => $validated['instituicao_id'] ?? null,
            'ativo' => $request->boolean('ativo', false),
        ];

        /*
         * A palavra-passe só é alterada se for preenchida.
         */
        if (!empty($validated['password'])) {
            $dados['password'] = Hash::make($validated['password']);
        }

        $utilizador->update($dados);

        return redirect()
            ->route('utilizadores.index')
            ->with('success', 'Utilizador atualizado com sucesso.');
    }

    /**
     * Elimina um utilizador.
     */
    public function destroy(User $utilizador)
    {
        /*
         * Impede que o utilizador autenticado
         * elimine a própria conta.
         */
        if ($utilizador->id === auth()->id()) {
            return redirect()
                ->route('utilizadores.index')
                ->with(
                    'error',
                    'Não é possível eliminar o próprio utilizador.'
                );
        }

        $utilizador->delete();

        return redirect()
            ->route('utilizadores.index')
            ->with('success', 'Utilizador eliminado com sucesso.');
    }
}


