<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RolePermissions seed - Asigna permisos a roles
 */
class RolePermissionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * @return void
     */
    public function run(): void
    {
        // role_has_permissions data - Basado en la estructura original
        $rolePermissions = [
            // Super-admin (role_id: 1) - Permisos de usuarios, roles, matriz y presupuesto
            ['permission_id' => 1, 'role_id' => 1],  // ver-usuarios
            ['permission_id' => 2, 'role_id' => 1],  // crear-usuarios
            ['permission_id' => 3, 'role_id' => 1],  // editar-usuarios
            ['permission_id' => 4, 'role_id' => 1],  // eliminar-usuarios
            ['permission_id' => 5, 'role_id' => 1],  // ver-roles
            ['permission_id' => 6, 'role_id' => 1],  // crear-roles
            ['permission_id' => 7, 'role_id' => 1],  // editar-roles
            ['permission_id' => 8, 'role_id' => 1],  // eliminar-roles
            ['permission_id' => 9, 'role_id' => 1],  // ver-matriz
            ['permission_id' => 10, 'role_id' => 1], // cargar-matriz
            ['permission_id' => 11, 'role_id' => 1], // eliminar-matriz
            ['permission_id' => 12, 'role_id' => 1], // ver-presupuesto
            
            // Usuario (role_id: 2) - Solo ver contacto, evento, oficio, convenio
            ['permission_id' => 13, 'role_id' => 2], // ver_municipalidad
            ['permission_id' => 17, 'role_id' => 2], // ver_contacto
            ['permission_id' => 21, 'role_id' => 2], // ver_evento
            ['permission_id' => 25, 'role_id' => 2], // ver_oficio
            ['permission_id' => 29, 'role_id' => 2], // ver_convenio
            
            // Editor (role_id: 3) - Ver y editar (sin eliminar)
            ['permission_id' => 13, 'role_id' => 3], // ver_municipalidad
            ['permission_id' => 14, 'role_id' => 3], // crear_municipalidad
            ['permission_id' => 15, 'role_id' => 3], // editar_municipalidad
            ['permission_id' => 17, 'role_id' => 3], // ver_contacto
            ['permission_id' => 18, 'role_id' => 3], // crear_contacto
            ['permission_id' => 19, 'role_id' => 3], // editar_contacto
            ['permission_id' => 21, 'role_id' => 3], // ver_evento
            ['permission_id' => 22, 'role_id' => 3], // crear_evento
            ['permission_id' => 23, 'role_id' => 3], // editar_evento
            ['permission_id' => 25, 'role_id' => 3], // ver_oficio
            ['permission_id' => 26, 'role_id' => 3], // crear_oficio
            ['permission_id' => 27, 'role_id' => 3], // editar_oficio
            ['permission_id' => 29, 'role_id' => 3], // ver_convenio
            ['permission_id' => 30, 'role_id' => 3], // crear_convenio
            ['permission_id' => 31, 'role_id' => 3], // editar_convenio
            
            // Admin (role_id: 4) - CRUD completo
            ['permission_id' => 13, 'role_id' => 4], // ver_municipalidad
            ['permission_id' => 14, 'role_id' => 4], // crear_municipalidad
            ['permission_id' => 15, 'role_id' => 4], // editar_municipalidad
            ['permission_id' => 16, 'role_id' => 4], // eliminar_municipalidad
            ['permission_id' => 17, 'role_id' => 4], // ver_contacto
            ['permission_id' => 18, 'role_id' => 4], // crear_contacto
            ['permission_id' => 19, 'role_id' => 4], // editar_contacto
            ['permission_id' => 20, 'role_id' => 4], // eliminar_contacto
            ['permission_id' => 21, 'role_id' => 4], // ver_evento
            ['permission_id' => 22, 'role_id' => 4], // crear_evento
            ['permission_id' => 23, 'role_id' => 4], // editar_evento
            ['permission_id' => 24, 'role_id' => 4], // eliminar_evento
            ['permission_id' => 25, 'role_id' => 4], // ver_oficio
            ['permission_id' => 26, 'role_id' => 4], // crear_oficio
            ['permission_id' => 27, 'role_id' => 4], // editar_oficio
            ['permission_id' => 28, 'role_id' => 4], // eliminar_oficio
            ['permission_id' => 29, 'role_id' => 4], // ver_convenio
            ['permission_id' => 30, 'role_id' => 4], // crear_convenio
            ['permission_id' => 31, 'role_id' => 4], // editar_convenio
            ['permission_id' => 32, 'role_id' => 4], // eliminar_convenio
            
            // Visitas (role_id: 5) - Solo ver presupuesto y eliminar matriz
            ['permission_id' => 12, 'role_id' => 5], // ver-presupuesto
            
            // Analista (role_id: 6) - Ver matriz y presupuesto
            ['permission_id' => 9, 'role_id' => 6],  // ver-matriz
            ['permission_id' => 12, 'role_id' => 6], // ver-presupuesto
            
            // Matriz-admin (role_id: 7) - Ver, cargar y eliminar matriz
            ['permission_id' => 9, 'role_id' => 7],  // ver-matriz
            ['permission_id' => 10, 'role_id' => 7], // cargar-matriz
            ['permission_id' => 11, 'role_id' => 7], // eliminar-matriz
            
            // Matriz-editor (role_id: 8) - Ver y cargar matriz
            ['permission_id' => 9, 'role_id' => 8],  // ver-matriz
            ['permission_id' => 10, 'role_id' => 8], // cargar-matriz
            
            // Matriz-usuario (role_id: 9) - Solo ver matriz
            ['permission_id' => 9, 'role_id' => 9],  // ver-matriz
        ];

        $table = $this->table('role_has_permissions');
        $table->insert($rolePermissions)->save();

        // model_has_roles data - Usuario Mario tiene super-admin y admin
        $modelRoles = [
            ['role_id' => 1, 'model_type' => 'App\Model\Entity\User', 'model_id' => 1],
            ['role_id' => 4, 'model_type' => 'App\Model\Entity\User', 'model_id' => 1],
        ];

        $table = $this->table('model_has_roles');
        $table->insert($modelRoles)->save();
    }
}
