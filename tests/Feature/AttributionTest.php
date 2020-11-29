<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Computer;
use App\Models\Attribution;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\AttributionCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AttributionTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAttribution()
    {

        $dataToTest =['id','date', 'time'];

        $attribution = Attribution::factory()->make();

        $ressource = (new AttributionCollection($attribution))->jsonSerialize();

        foreach($dataToTest as $data){
            $this->assertEquals($attribution->$data,$ressource[$data]);
        }
        $this->assertEquals($attribution['client_id'],$ressource['client']['id']);
    }
}
