<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\ORM\TableRegistry;

/**
 * SeedUsers command.
 */
class SeedUsersCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/5/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->setDescription('Genera 200 usuarios de prueba con el rol de usuario asignado');

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->out('Iniciando la creación de 200 usuarios de prueba...');
        
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $rolesTable = TableRegistry::getTableLocator()->get('Roles');
        $modelHasRolesTable = TableRegistry::getTableLocator()->get('ModelHasRoles');

        // Obtener el rol "usuario"
        $usuarioRole = $rolesTable->find()
            ->where(['name' => 'usuario'])
            ->first();

        if (!$usuarioRole) {
            $io->error('No se encontró el rol "usuario". Asegúrate de haber ejecutado el seeder de roles.');
            return static::CODE_ERROR;
        }

        $io->out('Rol "usuario" encontrado con ID: ' . $usuarioRole->id);

        // Nombres de ejemplo
        $nombres = [
            'Juan', 'María', 'Carlos', 'Ana', 'Luis', 'Carmen', 'José', 'Laura', 
            'Francisco', 'Isabel', 'Antonio', 'Dolores', 'Manuel', 'Pilar', 'David',
            'Teresa', 'Javier', 'Rosa', 'Daniel', 'Antonia', 'Rafael', 'Francisca',
            'Miguel', 'Cristina', 'Ángel', 'Josefa', 'Alejandro', 'Lucía', 'Fernando',
            'Mercedes', 'Pablo', 'Elena', 'Sergio', 'Marta', 'Jorge', 'Sara'
        ];

        $apellidos = [
            'García', 'Rodríguez', 'González', 'Fernández', 'López', 'Martínez',
            'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz', 'Hernández',
            'Díaz', 'Moreno', 'Muñoz', 'Álvarez', 'Romero', 'Alonso', 'Gutiérrez',
            'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Ramos', 'Gil', 'Ramírez',
            'Serrano', 'Blanco', 'Molina', 'Morales', 'Suárez', 'Ortega', 'Delgado',
            'Castro', 'Ortiz', 'Rubio', 'Marín', 'Sanz', 'Iglesias'
        ];

        $createdCount = 0;
        $errorCount = 0;

        for ($i = 1; $i <= 200; $i++) {
            // Generar nombre aleatorio
            $nombre = $nombres[array_rand($nombres)] . ' ' . $apellidos[array_rand($apellidos)] . ' ' . $apellidos[array_rand($apellidos)];
            $username = 'user' . $i;
            $email = 'user' . $i . '@test.com';
            $password = 'password123'; // Será hasheado automáticamente por el entity

            // Verificar si el usuario ya existe
            $existingUser = $usersTable->find()
                ->where(['OR' => [
                    ['email' => $email],
                    ['username' => $username]
                ]])
                ->first();

            if ($existingUser) {
                $io->warning("Usuario $username o email $email ya existe. Saltando...");
                $errorCount++;
                continue;
            }

            // Crear el usuario
            $user = $usersTable->newEntity([
                'name' => $nombre,
                'username' => $username,
                'email' => $email,
                'password' => $password
            ]);

            if ($usersTable->save($user)) {
                // Asignar el rol "usuario"
                $modelHasRole = $modelHasRolesTable->newEntity([
                    'role_id' => $usuarioRole->id,
                    'model_type' => 'App\\Model\\Entity\\User',
                    'model_id' => $user->id
                ]);

                if ($modelHasRolesTable->save($modelHasRole)) {
                    $createdCount++;
                    if ($createdCount % 20 == 0) {
                        $io->out("Creados $createdCount usuarios...");
                    }
                } else {
                    $io->error("Error al asignar rol al usuario $username");
                    $errorCount++;
                }
            } else {
                $io->error("Error al crear usuario $username: " . json_encode($user->getErrors()));
                $errorCount++;
            }
        }

        $io->out('');
        $io->success("✓ Proceso completado!");
        $io->out("  - Usuarios creados: $createdCount");
        if ($errorCount > 0) {
            $io->out("  - Errores: $errorCount");
        }

        return static::CODE_SUCCESS;
    }
}
