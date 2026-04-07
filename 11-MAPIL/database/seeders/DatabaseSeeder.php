<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\EventCategory;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ROLES =====
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'siswa']);

        // ===== USERS =====
        $admin = User::create([
            'name'     => 'Admin Tata Usaha',
            'email'    => 'admin@smkn1pwt.sch.id',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);
        $admin->assignRole('admin');

        $guru = User::create([
            'name'     => 'Budi Santoso, S.Pd',
            'email'    => 'budi@smkn1pwt.sch.id',
            'password' => bcrypt('password'),
            'role'     => 'guru',
        ]);
        $guru->assignRole('guru');

        $siswa = User::create([
            'name'     => 'Rina Agustina',
            'email'    => 'rina@siswa.smkn1pwt.sch.id',
            'password' => bcrypt('password'),
            'role'     => 'siswa',
        ]);
        $siswa->assignRole('siswa');

        // ===== ROOMS =====
        $rooms = [
            ['name' => 'Aula Utama',       'capacity' => 300, 'facilities' => 'Proyektor, Sound System, AC'],
            ['name' => 'Lab Komputer 1',   'capacity' => 36,  'facilities' => '36 PC, AC, Proyektor'],
            ['name' => 'Lab Komputer 2',   'capacity' => 36,  'facilities' => '36 PC, AC, Proyektor'],
            ['name' => 'Ruang Kelas A',    'capacity' => 36,  'facilities' => 'Papan tulis, Proyektor'],
            ['name' => 'Ruang Kelas B',    'capacity' => 36,  'facilities' => 'Papan tulis, Proyektor'],
            ['name' => 'Lapangan Basket',  'capacity' => 200, 'facilities' => 'Lampu, Tribun'],
            ['name' => 'Lapangan Upacara', 'capacity' => 1000,'facilities' => 'Tiang Bendera, Sound'],
            ['name' => 'Ruang Serbaguna',  'capacity' => 80,  'facilities' => 'Meja Lipat, Sound System'],
            ['name' => 'Ruang Rapat',      'capacity' => 20,  'facilities' => 'Meja Rapat, Proyektor, AC'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        // ===== EVENT CATEGORIES =====
        $categories = [
            ['name' => 'Lomba',       'color' => '#E74C3C', 'icon' => 'trophy'],
            ['name' => 'Ujian',       'color' => '#8E44AD', 'icon' => 'pencil'],
            ['name' => 'Upacara',     'color' => '#2E86AB', 'icon' => 'flag'],
            ['name' => 'Ekskul',      'color' => '#27AE60', 'icon' => 'star'],
            ['name' => 'Rapat',       'color' => '#E67E22', 'icon' => 'users'],
            ['name' => 'Seminar',     'color' => '#16A085', 'icon' => 'presentation'],
            ['name' => 'Olahraga',    'color' => '#F39C12', 'icon' => 'activity'],
            ['name' => 'Seni Budaya', 'color' => '#D35400', 'icon' => 'music'],
            ['name' => 'Lainnya',     'color' => '#95A5A6', 'icon' => 'calendar'],
        ];

        foreach ($categories as $cat) {
            EventCategory::create($cat);
        }
    }
}