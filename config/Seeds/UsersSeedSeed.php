<?php

declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * UsersSeed seed.
 */
class UsersSeedSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {

        $now = date('Y-m-d H:i:s');

        // Password to set (plaintext) — we'll hash it with bcrypt
        $plainPassword = '12345678';
        $bcryptHash = password_hash($plainPassword, PASSWORD_BCRYPT);

        $data = [
            [
                'id' => 1,
                'name' => 'Mario',
                'username' => 'mario',
                'email' => 'mario@gmail.com',
                'email_verified_at' => null,
                // store bcrypt hash of the desired password
                'password' => $bcryptHash,
                'remember_token' => null,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // If the user doesn't exist, insert. If it exists, update its password to the bcrypt hash.
        $exists = $this->fetchRow('SELECT id FROM users WHERE id = 1');
        if (!$exists) {
            $this->table('users')->insert($data)->save();
        } else {
            $this->execute('UPDATE users SET password = :password, updated_at = :updated_at WHERE id = :id', [
                'password' => $bcryptHash,
                'updated_at' => $now,
                'id' => $exists['id'],
            ]);
        }
    }
}
