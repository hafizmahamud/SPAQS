<?php

namespace Tests\Feature\Backend\Upkj;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\KelasUpkj;

/**
 * Class UpdateUserTest.
 */
class UpkjTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_upkj()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        KelasUpkj::create(
            [
            'tajuk' => 'Tajuk I',
            'keterangan' => 'KERJA-KERJA KEJURUTERAAN AWAM',
            ]
        );

        $response = KelasUpkj::where('id', '1')
                ->first();
        $this->assertEquals($response->id, '1');
    }

    /** @test */
    public function test_view_upkj()
    {
        $this->test_create_upkj();

        $response = $this->get('admin/auth/upkj')
            ->assertSee('Tajuk I');
    }

    /** @test */
    public function test_update_upkj()
    {
        $this->test_create_upkj();
        $this->patch('admin/auth/upkj', ['id' => '1'])
        ->assertSee('1');
    }

    /** @test */
    public function test_delete_upkj()
    {
        $this->test_create_upkj();
        KelasUpkj::where('id', '1')->delete();
        $this->assertDatabaseMissing('kelas_upkj', ['id' => '1']);
    }

}
