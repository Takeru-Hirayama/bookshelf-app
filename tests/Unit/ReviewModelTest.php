<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_relationships_are_defined(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $review = Review::factory()->for($user)->for($book)->create();
        $review->likedByUsers()->attach($user->id);

        $this->assertTrue($review->user->is($user));
        $this->assertTrue($review->book->is($book));
        $this->assertTrue($review->likedByUsers->contains($user));
    }
}
