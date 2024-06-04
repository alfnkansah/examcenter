<title>{{ env('APP_NAME') }}</title>
<!-- Open Graph meta tags for Facebook and other platforms -->
<meta property="og:title" content="{{ env('APP_NAME') }}">
<meta property="og:description"
    content="{{ env('APP_NAME') }} : Explore a world of Unlimited past questions (Pasco), and educational resources, all designed to help students excel in their studies">
<meta property="og:url" content="{{ env('APP_URL') }}">
<meta property="og:image" content="{{ asset('storage/images/logo/logo.png') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="ExamsCenter">
<meta property="og:type" content="article">

<!-- Twitter Card meta tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ env('APP_NAME') }}">
<meta name="twitter:description"
    content="{{ env('APP_NAME') }} : Explore a world of Unlimited past questions (Pasco), and educational resources, all designed to help students excel in their studies">
<meta name="twitter:image" content="{{ asset('storage/images/logo/logo.png') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ env('APP_URL') }}">
