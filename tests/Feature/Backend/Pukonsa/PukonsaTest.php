<?php

namespace Tests\Feature\Backend\Pukonsa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\KelasPukonsa;

/**
 * Class PukonsaTest.
 */
class PukonsaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_pukonsa()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        $this->pukonsa = KelasPukonsa::create(
            [
            'tajuk' => 'TAJUK 0',
            'keterangan' => 'Penerbitan',
            ]
        );

        $response = KelasPukonsa::where('id', $this->pukonsa->id)
                ->first();
        $this->assertEquals($response->id, $this->pukonsa->id);
    }

    /** @test */
    public function test_view_pukonsa()
    {
        $this->test_create_pukonsa();

        $response = $this->get('admin/auth/pukonsa')
            ->assertSee('TAJUK 0');
    }

    /** @test */
    public function test_update_pukonsa()
    {
        $this->test_create_pukonsa();
        $this->patch('admin/auth/pukonsa', ['id' => $this->pukonsa->id])
        ->assertSee($this->pukonsa->id);
    }

    /** @test */
    public function test_delete_pukonsa()
    {
        $this->test_create_pukonsa();
        KelasPukonsa::where('id', $this->pukonsa->id)->delete();
        $this->assertDatabaseMissing('kelas_pukonsa', ['id' => $this->pukonsa->id]);
    }

}
