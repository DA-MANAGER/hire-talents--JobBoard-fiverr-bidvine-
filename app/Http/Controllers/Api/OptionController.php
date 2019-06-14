<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OptionResource;
use App\Option;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class OptionController extends Controller
{
    public function index() {
        return OptionResource::collection(
            Option::getSiteOptions()
        );
    }
}
