<?php

declare(strict_types=1);

use Elastic\Adapter\Indices\Mapping;
use Elastic\Adapter\Indices\Settings;
use Elastic\Migrations\Facades\Index;
use Elastic\Migrations\MigrationInterface;

final class CreatePostIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        //
        Index::create('posts', function (Mapping $mapping, Settings $settings) {
            $mapping->integer('id');
            $mapping->text('title');
            $mapping->text('slug');
            $mapping->text('description');
            $mapping->integer('category');
            $mapping->text('content');
            $mapping->text('thumb');
            $mapping->boolean('active');
            $mapping->integer('author_id');
            $mapping->integer('approvor_id');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        //
        Index::drop('posts');
    }
}
