<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
interface HasMasterOwner {
    public function isMasterOwnedBy(Model $model) : bool;
}