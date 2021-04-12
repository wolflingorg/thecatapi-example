<?php

namespace tests;

use src\Clients\HttpClientInterface;
use src\Exceptions\ApiException;
use src\Apis\ImagesApi;
use PHPUnit\Framework\TestCase;

class ImagesApiTest extends TestCase
{
    const IMAGES_RESPONSE = <<<'RESPONSE'
[{"breeds":[],"id":"c5k","url":"https://cdn2.thecatapi.com/images/c5k.jpg","width":465,"height":700},{"breeds":[],"id":"MTcxMDM5OA","url":"https://cdn2.thecatapi.com/images/MTcxMDM5OA.jpg","width":500,"height":500},{"breeds":[],"id":"MjAwNjAwMQ","url":"https://cdn2.thecatapi.com/images/MjAwNjAwMQ.jpg","width":1280,"height":960},{"breeds":[{"weight":{"imperial":"6 - 16","metric":"3 - 7"},"id":"srex","name":"Selkirk Rex","cfa_url":"http://cfa.org/Breeds/BreedsSthruT/SelkirkRex.aspx","vetstreet_url":"http://www.vetstreet.com/cats/selkirk-rex","vcahospitals_url":"https://vcahospitals.com/know-your-pet/cat-breeds/selkirk-rex","temperament":"Active, Affectionate, Dependent, Gentle, Patient, Playful, Quiet, Social","origin":"United States","country_codes":"US","country_code":"US","description":"The Selkirk Rex is an incredibly patient, loving, and tolerant breed. The Selkirk also has a silly side and is sometimes described as clownish. She loves being a lap cat and will be happy to chat with you in a quiet voice if you talk to her. ","life_span":"14 - 15","indoor":0,"lap":1,"alt_names":"Shepherd Cat","adaptability":5,"affection_level":5,"child_friendly":4,"dog_friendly":5,"energy_level":3,"grooming":2,"health_issues":4,"intelligence":3,"shedding_level":1,"social_needs":3,"stranger_friendly":3,"vocalisation":3,"experimental":0,"hairless":0,"natural":0,"rare":0,"rex":1,"suppressed_tail":0,"short_legs":0,"wikipedia_url":"https://en.wikipedia.org/wiki/Selkirk_Rex","hypoallergenic":1,"reference_image_id":"II9dOZmrw"}],"id":"enV_ZqSpp","url":"https://cdn2.thecatapi.com/images/enV_ZqSpp.jpg","width":2005,"height":1375},{"breeds":[],"id":"u-tIJF0cw","url":"https://cdn2.thecatapi.com/images/u-tIJF0cw.jpg","width":1600,"height":1600}]
RESPONSE;

    /**
     * @test
     */
    public function we_can_perform_a_search()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::IMAGES_RESPONSE));

        $api = new ImagesApi($client);
        $results = $api->search();

        $this->assertIsArray($results);
    }

    /**
     * @test
     */
    public function we_throw_valid_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(
            $this->createMock(ApiException::class)
        );

        $api = new ImagesApi($client);

        $this->expectException(ApiException::class);

        $api->search();
    }
}