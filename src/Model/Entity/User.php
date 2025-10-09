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
}
