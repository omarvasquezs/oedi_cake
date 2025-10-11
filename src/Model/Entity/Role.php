<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Role extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'guard_name' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
