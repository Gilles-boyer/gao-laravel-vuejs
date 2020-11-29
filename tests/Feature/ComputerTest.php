<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\Computer;
use App\Models\Attribution;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ComputerCollection;
use App\Http\Resources\AttributionCollection;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ComputerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_computer_ressource()
    {

        $dataToTest =['id','name'];

        $attribution = Attribution::factory()->make();

        $computer = Computer::factory()->make();

        $ressource = (new ComputerCollection($computer))->jsonSerialize();
        $ressourceAttribution = (new AttributionCollection($attribution))->jsonSerialize();

        $ressource['attributions'] = $ressourceAttribution;

        foreach($dataToTest as $data){
            $this->assertEquals($computer->$data,$ressource[$data]);
        }
        $this->assertEquals($ressourceAttribution,$ressource['attributions']);
    }
}
