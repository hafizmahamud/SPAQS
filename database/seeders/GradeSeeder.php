<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\Grade;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

class GradeSeeder extends Seeder
{
    use TruncateTable;
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->disableForeignKeys();
        $this->truncate('grade');
        Grade::create(
            [
                'nama' => 'G1 (RM20,000 -RM200,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G2 (RM200,000 -RM500,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G3 (RM500,000 -RM1 000,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G4 (RM1 000,000 -RM2 000,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G5 (RM2 000,000 -RM5 000,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G6 (RM5 000,000 -RM10 000,000)',
            ]
        );

        Grade::create(
            [
                'nama' => 'G7( >RM10 000,000)',
            ]
        );
        $this->enableForeignKeys();
    }
}
