<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Client;
use App\Http\Resources\ClientCollection;

use PHPUnit\TextUI\XmlConfiguration\PHPUnit;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testClientUnit()
    {
        $dataToTest =['id','nickName'];

        $client = Client::factory()->make();

        $resource =(new ClientCollection($client))->jsonSerialize();

        foreach($dataToTest as $data){
            $this->assertEquals($client->$data,$resource[$data]);
        }
    }
}
