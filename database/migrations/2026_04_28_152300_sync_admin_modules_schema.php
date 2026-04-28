<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'site_name')) {
                $table->string('site_name')->default('Ayaka Josei Center');
            }
            if (!Schema::hasColumn('settings', 'site_tagline')) {
                $table->string('site_tagline')->nullable();
            }
            if (!Schema::hasColumn('settings', 'site_description')) {
                $table->text('site_description')->nullable();
            }
            if (!Schema::hasColumn('settings', 'instagram_url')) {
                $table->string('instagram_url')->nullable();
            }
            if (!Schema::hasColumn('settings', 'facebook_url')) {
                $table->string('facebook_url')->nullable();
            }
        });

        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('pages', 'slug')) {
                $table->string('slug')->nullable()->unique();
            }
            if (!Schema::hasColumn('pages', 'content')) {
                $table->json('content')->nullable();
            }
        });

        Schema::table('media', function (Blueprint $table) {
            if (!Schema::hasColumn('media', 'title')) {
                $table->string('title')->nullable()->after('file_size');
            }
            if (!Schema::hasColumn('media', 'type')) {
                $table->string('type')->default('gallery')->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $dropColumns = [];
            foreach (['site_name', 'site_tagline', 'site_description', 'instagram_url', 'facebook_url'] as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $dropColumns[] = $column;
                }
            }
            if ($dropColumns !== []) {
                $table->dropColumn($dropColumns);
            }
        });

        Schema::table('pages', function (Blueprint $table) {
            $dropColumns = [];
            foreach (['title', 'slug', 'content'] as $column) {
                if (Schema::hasColumn('pages', $column)) {
                    $dropColumns[] = $column;
                }
            }
            if ($dropColumns !== []) {
                $table->dropColumn($dropColumns);
            }
        });

        Schema::table('media', function (Blueprint $table) {
            $dropColumns = [];
            foreach (['title', 'type'] as $column) {
                if (Schema::hasColumn('media', $column)) {
                    $dropColumns[] = $column;
                }
            }
            if ($dropColumns !== []) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
