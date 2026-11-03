<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_レビュー投稿者のみが編集できる(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $genre = Genre::factory()->create();
        $book = Book::factory()->create(['user_id' => $owner->id]);
        $book->genres()->attach($genre->id);
        $review = Review::factory()->create(['user_id' => $owner->id, 'book_id' => $book->id]);

        $this->assertTrue($owner->can('update', $review));
        $this->assertFalse($other->can('update', $review));
    }

    public function test_レビュー投稿者のみが削除できる(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $genre = Genre::factory()->create();
        $book = Book::factory()->create(['user_id' => $owner->id]);
        $book->genres()->attach($genre->id);
        $review = Review::factory()->create(['user_id' => $owner->id, 'book_id' => $book->id]);

        $this->assertTrue($owner->can('delete', $review));
        $this->assertFalse($other->can('delete', $review));
    }
}
