<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        collect([
            'Kategori',
            'Kategori Tambah',
            'Kategori Edit',
            'Kategori Hapus',
            'Tag',
            'Tag Tambah',
            'Tag Edit',
            'Tag Hapus',
            'Blog',
            'Blog Tambah',
            'Blog Edit',
            'Blog Hapus',
            'Blog Tayang',
            'Pengguna',
            'Pengguna Tambah',
            'Pengguna Edit',
            'Pengguna Hapus',
            'Peran',
            'Peran Tambah',
            'Peran Edit',
            'Peran Hapus',
            'Hak Akses',
            'Hak Akses Tambah',
            'Hak Akses Edit',
            'Hak Akses Hapus',
        ])->each(fn ($permissionName) => Permission::create(['name' => $permissionName]));

        Role::create(['name' => 'Super Admin']);

        Role::create(['name' => 'Penulis'])->givePermissionTo([
            'Blog',
            'Blog Tambah',
            'Blog Edit',
            'Blog Hapus',
        ]);

        Role::create(['name' => 'Editor'])->givePermissionTo([
            'Kategori',
            'Kategori Tambah',
            'Kategori Edit',
            'Kategori Hapus',
            'Tag',
            'Tag Tambah',
            'Tag Edit',
            'Tag Hapus',
            'Blog',
            'Blog Tambah',
            'Blog Edit',
            'Blog Hapus',
            'Blog Tayang',
        ]);
    }
}