<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Cuescore\RankingDetails;

class CuescoreAPITest extends TestCase
{

    /**
     * Test if the cuescore API still has the right data
     * Todo: add more and different tests later
     *
     * @return void
     */
    public function test_cuescore_api_data()
    {
        $ranking = new RankingDetails();

        // Check if the tournament and ranking endpoint did not change and contains data
        // Also a check if the Ranking ID is still valid (two birds one stone)
        $this->assertTrue(!empty($ranking->tournaments_data));
        $this->assertTrue(!empty($ranking->ranking_data));

        // Check if I am still in the rankinglist
        $this->assertTrue(array_search('Rick van der Poel - van Zanden', array_column($ranking->ranking_data, 'name')) !== false);

        // Check if my player key still exists
        $this->assertTrue(key_exists(36238621, $ranking->ranking_data));
    }
}