<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Permissions seed.
 */
class PermissionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            // Permisos de Usuarios (1-4)
            ['id' => 1, 'name' => 'ver-usuarios', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'name' => 'crear-usuarios', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'name' => 'editar-usuarios', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'name' => 'eliminar-usuarios', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Roles (5-8)
            ['id' => 5, 'name' => 'ver-roles', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'name' => 'crear-roles', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 7, 'name' => 'editar-roles', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 8, 'name' => 'eliminar-roles', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Matriz (9-11)
            ['id' => 9, 'name' => 'ver-matriz', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 10, 'name' => 'cargar-matriz', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 11, 'name' => 'eliminar-matriz', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permiso de Presupuesto (12)
            ['id' => 12, 'name' => 'ver-presupuesto', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Municipalidad (13-16)
            ['id' => 13, 'name' => 'ver_municipalidad', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 14, 'name' => 'crear_municipalidad', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 15, 'name' => 'editar_municipalidad', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 16, 'name' => 'eliminar_municipalidad', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Contacto (17-20)
            ['id' => 17, 'name' => 'ver_contacto', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 18, 'name' => 'crear_contacto', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 19, 'name' => 'editar_contacto', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 20, 'name' => 'eliminar_contacto', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Evento (21-24)
            ['id' => 21, 'name' => 'ver_evento', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 22, 'name' => 'crear_evento', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 23, 'name' => 'editar_evento', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 24, 'name' => 'eliminar_evento', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Oficio (25-28)
            ['id' => 25, 'name' => 'ver_oficio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 26, 'name' => 'crear_oficio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 27, 'name' => 'editar_oficio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 28, 'name' => 'eliminar_oficio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            // Permisos de Convenio (29-32)
            ['id' => 29, 'name' => 'ver_convenio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 30, 'name' => 'crear_convenio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 31, 'name' => 'editar_convenio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 32, 'name' => 'eliminar_convenio', 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        $table = $this->table('permissions');
        $table->insert($data)->save();
    }
}
