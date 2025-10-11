<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class RoleHasPermission extends Entity
{
    protected array $_accessible = [
        'permission_id' => true,
        'role_id' => true,
        'permission' => true,
        'role' => true,
    ];
}
