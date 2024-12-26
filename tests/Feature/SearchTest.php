<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test whether the search page is accessible.
     *
     * @return void
     */
    public function test_search_page_is_accessible()
    {
        $this->get('/')
            ->assertOk();
    }

    /**
     * Add 3 products to database for testing if the search page has all 3 products accessible.
     *
     * @return void
     */    
    public function test_search_page_has_all_the_required_page_data()
    {
        // Arrange phase
        Product::factory()->count(3)->create(); // create 3 products

        // Act phase
        $response = $this->get('/');

        // Assert phase
        $items = Product::get();

        $response->assertViewIs('search')
            ->assertViewHas('items', $items);

    }

    public function test_search_page_shows_the_items()
    {
        Product::factory()->count(3)->create();

        $items = Product::get();

        $this->get('/')
            ->assertSeeInOrder([
                $items[0]->name,
                $items[1]->name,
                $items[2]->name,
            ]);
    }

    public function test_food_can_be_searched_given_a_query()
    {
        Product::factory()->create([
            'name' => 'Taco'
        ]);
        Product::factory()->create([
            'name' => 'Pizza'
        ]);
        Product::factory()->create([
            'name' => 'BBQ'
        ]);

        $this->get('/?query=bbq')
            ->assertSee('BBQ')
            ->assertDontSeeText('Pizza')
            ->assertDontSeeText('Taco');

        $this->get('/')
            ->assertSeeInOrder(['Taco', 'Pizza', 'BBQ']);
    }
}
