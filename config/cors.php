<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Các route cần CORS, bao gồm các API route và CSRF cookie route.

    'allowed_methods' => ['*'], // Cho phép tất cả các phương thức HTTP (GET, POST, PUT, DELETE, v.v.)

    'allowed_origins' => ['*'], // Cấu hình các nguồn (origin) được phép. Đảm bảo là domain frontend của bạn.

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Cho phép tất cả các header (ví dụ: Content-Type, Authorization)

    'exposed_headers' => [],

    'allow_credentials' => true, // Cho phép gửi cookies (nếu cần thiết).

    'max_age' => 0, // Thời gian cache cho preflight requests (bạn có thể tùy chỉnh).
];
