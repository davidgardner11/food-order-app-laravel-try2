<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class CartTest extends TestCase
{
    // use RefreshDatabase;

    public function test_item_can_be_added_to_the_cart()
    {
        Product::factory()->count(3)->create();

        $this->post('/cart', [
            'id' => 1,
        ])
        ->assertRedirect('/cart')
        ->assertSessionHasNoErrors()
        ->assertSessionHas('cart.0', [
            'id' => 1,
            'qty' => 1,
        ]);
    }

    public function test_same_item_cannot_be_added_to_the_cart_twice()
    {
        Product::factory()->create([
            'name' => 'Taco1',
            'cost' => 1.5,
            'image' => 'some-image.jpg',
        ]);
        Product::factory()->create([
            'name' => 'Pizza1',
            'cost' => 2.1,
            'image' => 'some-image.jpg',
        ]);
        Product::factory()->create([
            'name' => 'BBQ1',
            'cost' => 3.2,
            'image' => 'some-image.jpg',
        ]);

        $this->post('/cart', [
            'id' => 1, // Taco
        ]);
        $this->post('/cart', [
            'id' => 1, // Taco
        ]);
        $this->post('/cart', [
            'id' => 2, // Pizza
        ]);

        $this->assertEquals(2, count(session('cart')));
    }

    public function test_cart_page_can_be_accessed()
    {
        Product::factory()->count(3)->create();

        $this->get('/cart')
            ->assertViewIs('cart');

    }

    public function test_items_added_to_the_cart_can_be_seen_in_the_cart_page()
    {
        $taco = Product::factory()->create([
            'name' => 'Taco2',
            'cost' => 1.5,
            'image' => 'some-image.jpg',
        ]);
        
        $pizza = Product::factory()->create([
            'name' => 'Pizza2',
            'cost' => 2.1,
            'image' => 'some-image.jpg',
        ]);
        
        $bbq = Product::factory()->create([
            'name' => 'BBQ2',
            'cost' => 3.2,
            'image' => 'some-image.jpg',
        ]);

        $this->post('/cart', [
            'id' => $taco->id,
        ]);
        
        $this->post('/cart', [
            'id' => $bbq->id,
        ]);

        $response = $this->get('/cart');
        
        $response->assertViewIs('cart')
                ->assertViewHas('cart_items')
                ->assertSeeText('Taco2')
                ->assertSeeText('BBQ2')
                ->assertDontSeeText('Pizza2');
    }


/*     public function test_items_added_to_the_cart_can_be_seen_in_the_cart_page()
    {

        Product::factory()->create([
            'name' => 'Taco2',
            'cost' => 1.5,
            'image' => 'some-image.jpg',
        ]);
        Product::factory()->create([
            'name' => 'Pizza2',
            'cost' => 2.1,
            'image' => 'some-image.jpg',
        ]);
        Product::factory()->create([
            'name' => 'BBQ2',
            'cost' => 3.2,
            'image' => 'some-image.jpg',
        ]);

        $this->post('/cart', [
            'id' => 1, // Taco
        ]);
        $this->post('/cart', [
            'id' => 3, // BBQ
        ]);

        $cart_items = [
            [
                'id' => 1,
                'qty' => 1,
                'name' => 'Taco2',
                'image' => 'some-image.jpg',
                'cost' => 1.5,
            ],
            [
                'id' => 3,
                'qty' => 1,
                'name' => 'BBQ2',
                'image' => 'some-image.jpg',
                'cost' => 3.2,
            ],
        ];

        $this->get('/cart')
            ->assertViewHas('cart_items', $cart_items)
            ->assertSeeTextInOrder([
                'Taco',
                'BBQ',
            ])
            ->assertDontSeeText('Pizza');

    } */
}
