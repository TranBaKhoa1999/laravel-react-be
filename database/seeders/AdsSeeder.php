<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdsSeeder extends Seeder
{
    public function run()
    {
        // Tạo Advertiser
        $advertiserId = DB::table('ads_advertisers')->insertGetId([
            'name' => 'Sample Advertiser',
            'email' => 'advertiser@example.com',
            'phone' => '123456789',
            'company' => 'Sample Company',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Tạo Campaign
        $campaignId = DB::table('ads_campaigns')->insertGetId([
            'advertiser_id' => $advertiserId,
            'name' => 'Summer Sale 2025',
            'start_date' => '2025-06-01',
            'end_date' => '2025-08-31',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Tạo Line Items
        $lineItems = [
            ['name' => 'Mobile Header', 'position_key' => 'mb_header', 'device_type' => 'mobile', 'position_x' => 320, 'position_y' => 50],
            ['name' => 'Mobile Sidebar', 'position_key' => 'mb_sidebar', 'device_type' => 'mobile', 'position_x' => 300, 'position_y' => 250],
            ['name' => 'Desktop Header', 'position_key' => 'desktop_header', 'device_type' => 'desktop', 'position_x' => 728, 'position_y' => 90],
        ];

        foreach ($lineItems as $lineItem) {
            $lineItemId = DB::table('ads_line_items')->insertGetId([
                'campaign_id' => $campaignId,
                'name' => $lineItem['name'],
                'position_key' => $lineItem['position_key'],
                'page_slug' => json_encode(['', 'product', 'contact']),
                'position_x' => $lineItem['position_x'],
                'position_y' => $lineItem['position_y'],
                'target' => json_encode(['location' => 'Vietnam', 'age' => '18-35']),
                'allowed_sizes' => json_encode(['300x600','300x250','320x50','320x100','320x480','336x280','468x60','728x90','970x250']),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Tạo Ad Sets
            for ($i = 1; $i <= rand(1, 2); $i++) {
                $adSetId = DB::table('ads_sets')->insertGetId([
                    'line_item_id' => $lineItemId,
                    'name' => $lineItem['name'] . ' - Ad Set ' . $i,
                    'type' => 'image',
                    'width' => 300,
                    'height' => 600,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Tạo Creatives
                DB::table('ads_creatives')->insert([
                    'ad_set_id' => $adSetId,
                    'content_url' => '/images/ads/300x600.png',
                    'click_url' => 'https://youtube.com',
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
