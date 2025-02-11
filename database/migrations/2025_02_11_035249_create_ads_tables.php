<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ads_advertisers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
        });

        Schema::create('ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertiser_id')->constrained('ads_advertisers')->onDelete('cascade');
            $table->string('name'); // ex: "Summer Sale 2025", "Black Friday 2025"
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('ads_line_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('ads_campaigns')->onDelete('cascade');
            $table->string('name');// ex: "Mobile Banner Header", " Mobile Sidebar Right", "Desktop Banner Header", "Desktop Sidebar Right",...
            $table->string('position_key');  // ex: "mb_banner_header", "mb_sidebar_header",...
            $table->json('page_slug')->nullable()->comment('list page will show ads');
            $table->integer('position_x')->comment('width')->nullable(); // ex: 320, 300, 728, 1600
            $table->integer('position_y')->comment('height')->nullable(); // ex: 50, 90, 250, 600
            $table->json('allowed_sizes')->nullable(); // ex: "[{width: 320, height: 50}, {width: 300, height: 90}]" // excepted ads sizes
            $table->json('target')->nullable(); // ex: "{device: 'mobile', os: 'android', location: 'Vietnam'}"
            $table->timestamps();
        });

        Schema::create('ads_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('line_item_id')->constrained('ads_line_items')->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['image', 'video', 'text'])->default('image');
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });

        Schema::create('ads_creatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_set_id')->constrained('ads_sets')->onDelete('cascade');
            $table->string('content_url');
            $table->string('click_url');
            $table->foreignId('storage_id')->nullable()->constrained('storages')->onDelete('set null');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ads_creatives');
        Schema::dropIfExists('ads_sets');
        Schema::dropIfExists('ads_line_items');
        Schema::dropIfExists('ads_campaigns');
        Schema::dropIfExists('ads_advertisers');
    }
};
