<?php

namespace App\Models;

enum Roles: string {
    case Reader = "reader";
    case Author = "author";
    case Admin = "admin";
}