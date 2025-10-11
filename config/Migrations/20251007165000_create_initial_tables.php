<?php

use Phinx\Migration\AbstractMigration;

class CreateInitialTables extends AbstractMigration
{
    public function change(): void
    {
        // municipalidades
        $table = $this->table('municipalidades', ['id' => false, 'primary_key' => ['id_municipalidad']]);
        $table->addColumn('id_municipalidad', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('ubigeo', 'string', ['limit' => 10])
            ->addColumn('nombre', 'text')
            ->addColumn('departamento', 'string', ['limit' => 80])
            ->addColumn('provincia', 'string', ['limit' => 80])
            ->addColumn('distrito', 'string', ['limit' => 80])
            ->addColumn('region', 'string', ['limit' => 50])
            ->addColumn('nivel', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('region_natural', 'string', ['limit' => 50])
            ->addColumn('X', 'decimal', ['precision' => 10, 'scale' => 6, 'null' => true])
            ->addColumn('Y', 'decimal', ['precision' => 10, 'scale' => 6, 'null' => true])
            ->addColumn('RUC', 'string', ['limit' => 11, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->addIndex(['ubigeo'], ['unique' => true])
            ->create();

        // bitacora
        $table = $this->table('bitacora', ['id' => false, 'primary_key' => ['id_bitacora']]);
        $table->addColumn('id_bitacora', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_usuario', 'biginteger', ['signed' => false])
            ->addColumn('accion', 'string', ['limit' => 50])
            ->addColumn('tabla_afectada', 'string', ['limit' => 50])
            ->addColumn('id_registro_afectado', 'biginteger', ['signed' => false])
            ->addColumn('detalle', 'text', ['null' => true])
            ->addColumn('fecha', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();

        // contactos
        $table = $this->table('contactos', ['id' => false, 'primary_key' => ['id_contacto']]);
        $table->addColumn('id_contacto', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_municipalidad', 'biginteger', ['signed' => false])
            ->addColumn('nombre_completo', 'text')
            ->addColumn('cargo', 'text')
            ->addColumn('telefono', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // convenios
        $table = $this->table('convenios', ['id' => false, 'primary_key' => ['id_convenio']]);
        $table->addColumn('id_convenio', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_municipalidad', 'biginteger', ['signed' => false])
            ->addColumn('tipo_convenio', 'string', ['limit' => 100])
            ->addColumn('monto', 'decimal', ['precision' => 20, 'scale' => 2])
            ->addColumn('fecha_firma', 'date')
            ->addColumn('id_estado_convenio', 'biginteger', ['signed' => false])
            ->addColumn('descripcion', 'text', ['null' => true])
            ->addColumn('codigo_convenio', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('codigo_idea_cui', 'integer', ['null' => true])
            ->addColumn('descripcion_idea_cui', 'string', ['limit' => 250, 'null' => true])
            ->addColumn('beneficiarios', 'integer', ['null' => true])
            ->addColumn('codigo_interno', 'string', ['limit' => 20])
            ->addColumn('id_sector', 'biginteger', ['signed' => false])
            ->addColumn('id_direccion_linea', 'biginteger', ['signed' => false])
            ->addColumn('creado_por', 'biginteger', ['signed' => false])
            ->addColumn('actualizado_por', 'biginteger', ['signed' => false])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->addIndex(['codigo_interno'])
            ->create();

        // convenios_seguimiento
        $table = $this->table('convenios_seguimiento', ['id' => false, 'primary_key' => ['id_convenio_seguimiento']]);
        $table->addColumn('id_convenio_seguimiento', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_convenio', 'biginteger', ['signed' => false])
            ->addColumn('fecha', 'date')
            ->addColumn('id_estado_convenio', 'biginteger', ['signed' => false])
            ->addColumn('comentarios', 'text', ['null' => true])
            ->addColumn('acciones_realizadas', 'text', ['null' => true])
            ->addColumn('alertas_identificadas', 'text', ['null' => true])
            ->addColumn('acciones_desarrollar', 'text', ['null' => true])
            ->addColumn('fecha_seguimiento', 'date', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // direccion_linea
        $table = $this->table('direccion_linea', ['id' => false, 'primary_key' => ['id_direccion_linea']]);
        $table->addColumn('id_direccion_linea', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('descripcion', 'text')
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // estados
        $table = $this->table('estados', ['id' => false, 'primary_key' => ['id_estado']]);
        $table->addColumn('id_estado', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('descripcion', 'text')
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // estados_convenios
        $table = $this->table('estados_convenios', ['id' => false, 'primary_key' => ['id_estado_convenio']]);
        $table->addColumn('id_estado_convenio', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('descripcion', 'string', ['limit' => 100])
            ->addColumn('nombre', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // estados_seguimiento
        $table = $this->table('estados_seguimiento', ['id' => false, 'primary_key' => ['id_estado']]);
        $table->addColumn('id_estado', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_evento', 'biginteger', ['signed' => false])
            ->addColumn('id_contacto', 'biginteger', ['signed' => false])
            ->addColumn('id_tipo_reunion', 'biginteger', ['signed' => false])
            ->addColumn('fecha', 'date')
            ->addColumn('id_estado_ref', 'biginteger', ['signed' => false])
            ->addColumn('descripcion', 'text', ['null' => true])
            ->addColumn('compromiso', 'text', ['null' => true])
            ->addColumn('fecha_compromiso', 'date', ['null' => true])
            ->addColumn('compromiso_concluido', 'boolean', ['null' => true])
            ->addColumn('creado_por', 'biginteger', ['signed' => false])
            ->addColumn('actualizado_por', 'biginteger', ['signed' => false])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // eventos
        $table = $this->table('eventos', ['id' => false, 'primary_key' => ['id_evento']]);
        $table->addColumn('id_evento', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_municipalidad', 'biginteger', ['signed' => false])
            ->addColumn('id_contacto', 'biginteger', ['signed' => false])
            ->addColumn('tipo_acercamiento', 'text')
            ->addColumn('lugar', 'text')
            ->addColumn('fecha', 'date')
            ->addColumn('modalidad', 'string', ['limit' => 40, 'null' => true])
            ->addColumn('descripcion', 'text', ['null' => true])
            ->addColumn('creado_por', 'biginteger', ['signed' => false])
            ->addColumn('actualizado_por', 'biginteger', ['signed' => false])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // oficios
        $table = $this->table('oficios', ['id' => false, 'primary_key' => ['id_oficio']]);
        $table->addColumn('id_oficio', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('id_municipalidad', 'biginteger', ['signed' => false])
            ->addColumn('numero_oficio', 'string', ['limit' => 255])
            ->addColumn('fecha_envio', 'date')
            ->addColumn('asunto', 'string', ['limit' => 255])
            ->addColumn('contenido', 'text')
            ->addColumn('estado', 'string', ['limit' => 50])
            ->addColumn('creado_por', 'biginteger', ['signed' => false])
            ->addColumn('actualizado_por', 'biginteger', ['signed' => false])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->addIndex(['numero_oficio'])
            ->create();

        // permissions
        $table = $this->table('permissions');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('guard_name', 'string', ['limit' => 255])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addIndex(['name'])
            ->create();

        // roles
        $table = $this->table('roles');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('guard_name', 'string', ['limit' => 255])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addIndex(['name'])
            ->create();

        // model_has_roles (composite key)
        $table = $this->table('model_has_roles', ['id' => false, 'primary_key' => ['role_id', 'model_type', 'model_id']]);
        $table->addColumn('role_id', 'biginteger', ['signed' => false])
            ->addColumn('model_type', 'string', ['limit' => 255])
            ->addColumn('model_id', 'biginteger', ['signed' => false])
            ->create();

        // role_has_permissions (composite key)
        $table = $this->table('role_has_permissions', ['id' => false, 'primary_key' => ['permission_id', 'role_id']]);
        $table->addColumn('permission_id', 'biginteger', ['signed' => false])
            ->addColumn('role_id', 'biginteger', ['signed' => false])
            ->create();

        // sector
        $table = $this->table('sector', ['id' => false, 'primary_key' => ['id_sector']]);
        $table->addColumn('id_sector', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('descripcion', 'text')
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // tipos_reunion
        $table = $this->table('tipos_reunion', ['id' => false, 'primary_key' => ['id_tipo_reunion']]);
        $table->addColumn('id_tipo_reunion', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('descripcion', 'text')
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();

        // users
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('username', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('email_verified_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('remember_token', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['username'], ['unique' => true])
            ->create();
    }
}
