<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ModelHasRole extends Entity
{
    protected array $_accessible = [
        'role_id' => true,
        'model_type' => true,
        'model_id' => true,
        'role' => true,
    ];
}
