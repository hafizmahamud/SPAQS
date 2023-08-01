<?php

namespace Tests\Feature\Backend\Announcement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Domains\Announcement\Models\Announcement;


/**
 * Class AnnouncementTest.
 */
class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_announcement()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        Announcement::create(
            [
                'id' => '2',
                'type' => 'info',
                'message' => 'test',
                'enabled' => 't',
            ]
        );

        $response = Announcement::where('id', '2')
                ->first();
        $this->assertEquals($response->id, '2');
    }

    /** @test */
    public function test_edit_announcement()
    {
        $this->test_create_announcement();

        $response = $this->get('admin/auth/announcement/2/edit')
            ->assertSee('test');
    }

    /** @test */
    public function test_update_announcement()
    {
        $this->test_create_announcement();
        $this->patch('admin/auth/announcement', ['id' => '2'])
        ->assertSee('2');
    }

    /** @test */
    public function test_delete_announcement()
    {
        $this->test_create_announcement();
        Announcement::where('id', '2')->delete();
        $this->assertDatabaseMissing('announcements', ['id' => '2']);
    }

}
