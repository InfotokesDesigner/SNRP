<?php

namespace App\Traits;

use App\Services\AuditoriaService;

trait Auditable
{
    /**
     * Regista automaticamente as operações de criação,
     * edição e eliminação do registo.
     */
    public static function bootAuditable(): void
    {
        static::created(function ($model) {
            AuditoriaService::registrar(
                'criar',
                $model->getAuditoriaModulo(),
                $model->getAuditoriaDescricao('criar'),
                $model,
                null,
                $model->getAuditoriaDados()
            );
        });

        static::updated(function ($model) {
            AuditoriaService::registrar(
                'editar',
                $model->getAuditoriaModulo(),
                $model->getAuditoriaDescricao('editar'),
                $model,
                $model->getAuditoriaDadosAnteriores(),
                $model->getAuditoriaDados()
            );
        });

        static::deleted(function ($model) {
            AuditoriaService::registrar(
                'eliminar',
                $model->getAuditoriaModulo(),
                $model->getAuditoriaDescricao('eliminar'),
                $model,
                $model->getAuditoriaDados(),
                null
            );
        });
    }

    /**
     * Define o módulo da auditoria.
     */
    public function getAuditoriaModulo(): string
    {
        return strtolower(class_basename($this));
    }

    /**
     * Cria uma descrição padrão para a auditoria.
     */
    public function getAuditoriaDescricao(string $acao): string
    {
        $modelo = class_basename($this);

        return match ($acao) {
            'criar' => "{$modelo} criado.",
            'editar' => "{$modelo} atualizado.",
            'eliminar' => "{$modelo} eliminado.",
            default => "Operação '{$acao}' realizada em {$modelo}.",
        };
    }

    /**
     * Obtém os dados atuais do registo.
     *
     * Campos sensíveis nunca devem ser armazenados
     * no histórico de auditoria.
     */
    public function getAuditoriaDados(): array
    {
        $dados = $this->getAttributes();

        unset(
            $dados['password'],
            $dados['remember_token']
        );

        return $dados;
    }

    /**
     * Obtém os dados anteriores à alteração.
     */
    public function getAuditoriaDadosAnteriores(): array
    {
        $dados = $this->getRawOriginal();

        unset(
            $dados['password'],
            $dados['remember_token']
        );

        return $dados;
    }
}