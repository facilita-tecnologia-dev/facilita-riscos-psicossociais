<?php

namespace Database\Seeders\RolePermissions;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::insert([
            [
                'name' => 'Editar perfil dos colaboradores',
                'key_name' => 'user_edit',
                'description' => 'Habilita o usuário para editar o perfil dos colaboradores.',
            ],
            [
                'name' => 'Ver perfil dos colaboradores',
                'key_name' => 'user_show',
                'description' => 'Habilita o usuário para ver o perfil dos colaboradores.',
            ],
            [
                'name' => 'Ver lista de colaboradores',
                'key_name' => 'user_index',
                'description' => 'Habilita o usuário para ver a lista de colaboradores.',
            ],
            [
                'name' => 'Criar/Importar colaboradores',
                'key_name' => 'user_create',
                'description' => 'Habilita o usuário para criar ou importar colaboradores.',
            ],
            [
                'name' => 'Responder Testes',
                'key_name' => 'answer_tests',
                'description' => 'Habilita o usuário a responder formulários de testes.',
            ],
            [
                'name' => 'Excluir colaboradores',
                'key_name' => 'user_delete',
                'description' => 'Habilita o usuário para excluir colaboradores.',
            ],
            [
                'name' => 'Ver Lista de Comentários de Clima Organizacional',
                'key_name' => 'feedbacks_index',
                'description' => 'Habilita o usuário para ver a Lista de Comentários de Clima Organizacional.',
            ],
            [
                'name' => 'Ver Dashboard de Índices Demográficos',
                'key_name' => 'demographics_dashboard_view',
                'description' => 'Habilita o usuário para ver a tela do Dashboard de Índices Demográficos.',
            ],
            [
                'name' => 'Ver Dashboard de Clima Organizacional',
                'key_name' => 'organizational_dashboard_view',
                'description' => 'Habilita o usuário para ver as telas do Dashboard de Clima Organizacional.',
            ],
            [
                'name' => 'Ver Dashboard de Riscos Psicossociais',
                'key_name' => 'psychosocial_dashboard_view',
                'description' => 'Habilita o usuário para ver as telas do Dashboard de Riscos Psicossociais.',
            ],
            [
                'name' => 'Editar Dados de Desempenho',
                'key_name' => 'metrics_edit',
                'description' => 'Habilita o usuário para editar os Dados de Desempenho Organizacional da empresa.',
            ],
            [
                'name' => 'Ver perfil da empresa',
                'key_name' => 'company_show',
                'description' => 'Habilita o usuário para ver o perfil da empresa.',
            ],
            [
                'name' => 'Editar perfil da empresa',
                'key_name' => 'company_edit',
                'description' => 'Habilita o usuário para editar o perfil da empresa.',
            ],
            [
                'name' => 'Excluir campanhas',
                'key_name' => 'campaign_delete',
                'description' => 'Habilita o usuário para excluir as campanhas da empresa.',
            ],
            [
                'name' => 'Editar campanhas',
                'key_name' => 'campaign_edit',
                'description' => 'Habilita o usuário para editar as campanhas da empresa.',
            ],
            [
                'name' => 'Criar campanhas',
                'key_name' => 'campaign_create',
                'description' => 'Habilita o usuário para criar campanhas para a empresa.',
            ],
            [
                'name' => 'Ver detalhes das campanhas',
                'key_name' => 'campaign_show',
                'description' => 'Habilita o usuário para ver os detalhes das campanhas da empresa.',
            ],
            [
                'name' => 'Ver lista de campanhas',
                'key_name' => 'campaign_index',
                'description' => 'Habilita o usuário para ver as campanhas da empresa.',
            ],
            [
                'name' => 'Editar permissões dos colaboradores',
                'key_name' => 'user_permission_edit',
                'description' => 'Habilita o usuário a editar as permissões dos colaboradores.',
            ],
            [
                'name' => 'Editar Visão de Setores dos colaboradores',
                'key_name' => 'user_department_scope_edit',
                'description' => 'Habilita o usuário para editar a Visão de Setores dos colaboradores.',
            ],
            [
                'name' => 'Ver documentação do sistema',
                'key_name' => 'documentation_show',
                'description' => 'Habilita o usuário para ver a documentação do sistema.',
            ],
            [
                'name' => 'Ver lista de Coleções de Testes',
                'key_name' => 'collections_index',
                'description' => 'Habilita o usuário para ver a lista de coleções de testes da empresa.',
            ],
            [
                'name' => 'Editar Coleções de Testes',
                'key_name' => 'collections_edit',
                'description' => 'Habilita o usuário para editar as coleções de testes da empresa.',
            ],
            [
                'name' => 'Redefinir senha da empresa',
                'key_name' => 'company_reset_password',
                'description' => 'Habilita o usuário para redefinir a senha de login da empresa.',
            ],
            [
                'name' => 'Excluir conta da empresa',
                'key_name' => 'company_delete',
                'description' => 'Habilita o usuário para excluir permanentemente a conta da empresa.',
            ],
            [
                'name' => 'Editar Plano de Ação da empresa',
                'key_name' => 'action_plan_edit',
                'description' => 'Habilita o usuário para editar o Plano de Ação da empresa.',
            ],
        ]);

        $this->call(RolePermissionSeeder::class);
    }
}
