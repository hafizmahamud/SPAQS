<?php

namespace Tests\Feature\Backend\SubKelasPukonsa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;

/**
 * Class SubKelasPukonsaTest.
 */
class SubKelasPukonsaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_subkelaspukonsa()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        $this->pukonsa = KelasPukonsa::create(
            [
            'tajuk' => 'TAJUK 0',
            'keterangan' => 'Penerbitan',
            ]
        );

        $this->subpukonsa = SubKelasPukonsa::create(
            [
            'tajuk_kecil' => 'TAJUK 01',
            'keterangan' => 'Bahan Bacaan',
            'tajuk_id' => $this->pukonsa->id,
            ]
        );

        $response = SubKelasPukonsa::where('id', $this->subpukonsa->id)
                ->first();
        $this->assertEquals($response->id, $this->subpukonsa->id);
    }

    /** @test */
    public function test_view_subkelaspukonsa()
    {
        $this->test_create_subkelaspukonsa();

        $response = $this->get('admin/auth/subKelasPukonsa')
            ->assertSee('TAJUK 01');
    }

    /** @test */
    public function test_update_subkelaspukonsa()
    {
        $this->test_create_subkelaspukonsa();
        $this->patch('admin/auth/subKelasPukonsa', ['id' => $this->subpukonsa->id])
        ->assertSee($this->subpukonsa->id);
    }

    /** @test */
    public function test_delete_subkelaspukonsa()
    {
        $this->test_create_subkelaspukonsa();
        SubKelasPukonsa::where('id', $this->subpukonsa->id)->delete();
        $this->assertDatabaseMissing('subkelas_pukonsa', ['id' => $this->subpukonsa->id]);
    }
}
