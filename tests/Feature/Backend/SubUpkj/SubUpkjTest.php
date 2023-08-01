<?php

namespace Tests\Feature\Backend\SubUpkj;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasUpkj;

/**
 * Class UpdateUserTest.
 */
class SubUpkjTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_subUpkj()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        KelasUpkj::create(
            [
            'tajuk' => 'Tajuk I',
            'keterangan' => 'KERJA-KERJA KEJURUTERAAN AWAM',
            ]
        );

        SubKelasUpkj::create(
            [
            'tajuk_kecil' => 'TAJUK KECIL 10',
            'keterangan' => 'KERJA KERJA AM KEJURUTERAAN AWAM',
            'tajuk_id' => '4',
            ]
        );

        $response = SubKelasUpkj::where('id', '1')
                ->first();
        $this->assertEquals($response->id, '1');
    }

    /** @test */
    public function test_view_subUpkj()
    {
        $this->test_create_subUpkj();

        $response = $this->get('admin/auth/subUpkj')
            ->assertSee('TAJUK KECIL 1');
    }

    /** @test */
    public function test_update_subUpkj()
    {
        $this->test_create_subUpkj();
        $this->patch('admin/auth/subUpkj', ['id' => '1'])
        ->assertSee('1');
    }

    /** @test */
    public function test_delete_subUpkj()
    {
        $this->test_create_subUpkj();
        SubKelasUpkj::where('id', '1')->delete();
        $this->assertDatabaseMissing('subkelas_upkj', ['id' => '1']);
    }

}
