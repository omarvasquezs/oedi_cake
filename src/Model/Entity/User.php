<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    // Make all fields mass assignable for now (adjust for security in production)
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];

    // Hide the password field when converting to arrays/JSON
    protected array $_hidden = ['password'];

    // Automatically hash passwords when they are changed
    // Using PASSWORD_BCRYPT to match the seeder configuration
    /**
     * Password setter that hashes the plain password using bcrypt.
     *
     * @param string $password Plain password
     * @return string|null Hashed password or null when empty
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return password_hash($password, PASSWORD_BCRYPT);
        }

        return null;
    }
}
