<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];

    public static function createTable(): void
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('password')->nullable();
                $table->timestamps();
            });
        }
    }
}
