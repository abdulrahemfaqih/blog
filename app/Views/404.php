<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotFound Pages</title>
    <script src="<?= base_url("js/main.js") ?>"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- 404 Page -->
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="text-center relative">
            <h1 class="text-[200px] font-bold text-gray-100">404</h1>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <!-- 404 Illustration -->
                <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Confused Face -->
                    <circle cx="100" cy="100" r="80" fill="#F3F4F6" />
                    <!-- Eyes -->
                    <circle cx="65" cy="90" r="10" fill="#374151" />
                    <circle cx="135" cy="90" r="10" fill="#374151" />
                    <!-- Confused Mouth -->
                    <path d="M60 130 C90 110, 110 110, 140 130" stroke="#374151" stroke-width="8" stroke-linecap="round"
                        fill="none" />
                    <!-- Question Marks -->
                    <text x="40" y="50" font-size="24" fill="#4B5563" transform="rotate(-15, 40, 50)">?</text>
                    <text x="150" y="50" font-size="24" fill="#4B5563" transform="rotate(15, 150, 50)">?</text>
                </svg>
            </div>
        </div>
        <div class="text-center mt-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Page Not Found</h2>
            <p class="text-gray-600 mb-8 max-w-lg">
                The page you are looking for might have been removed, had its name changed, or is temporarily
                unavailable.
            </p>
            <div class="space-y-3">
                <a href="<?= route_to("index") ?>" class="inline-block px-8 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                    Back to Home
                </a>
                <p class="text-sm text-gray-500 mt-4">
                    Error Code: 404_PAGE_NOT_FOUND
                </p>
            </div>
        </div>
    </div>
</body>

</html>