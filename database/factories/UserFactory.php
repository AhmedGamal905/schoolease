<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a user with the 'user' role.
     *
     * @return \App\Models\User
     */
    public function withUserRole()
    {
        $role = Role::firstOrCreate(['name' => 'user']);

        $user = $this->create();

        $user->assignRole($role);

        return $user;
    }

    /**
     * Create a user with the 'teacher' role.
     *
     * @return \App\Models\User
     */
    public function withTeacherRole()
    {
        $role = Role::firstOrCreate(['name' => 'teacher']);

        $user = $this->create();

        $user->assignRole($role);

        return $user;
    }

    /**
     * Create a user with the 'super-admin' role.
     *
     * @return \App\Models\User
     */
    public function withAdminRole()
    {
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        $user = $this->create();

        $user->assignRole($role);

        return $user;
    }
}
