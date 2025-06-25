<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Test database connection
echo "Testing database connection...<br>";
try {
    $stmt = $pdo->query("SELECT 1");
    echo "✓ Database connected successfully<br>";
} catch(Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Test settings table
echo "<br>Testing site_settings table...<br>";
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'site_settings'");
    if ($stmt->rowCount() > 0) {
        echo "✓ site_settings table exists<br>";
        
        // Check current settings
        $settings = getSettings();
        echo "Current settings:<br>";
        echo "- Site Title: " . ($settings['site_title'] ?? 'NULL') . "<br>";
        echo "- Tagline: " . ($settings['tagline'] ?? 'NULL') . "<br>";
        
        // Test update
        echo "<br>Testing settings update...<br>";
        $testData = [
            'site_title' => 'Test Portfolio ' . date('H:i:s'),
            'tagline' => 'Test Tagline ' . date('H:i:s'),
            'about_text' => 'Test about text',
            'contact_email' => 'test@example.com',
            'profile_image_url' => '',
            'social_links' => ['linkedin' => '', 'github' => '', 'twitter' => '']
        ];
        
        if (updateSettings($testData)) {
            echo "✓ Settings update successful<br>";
            
            // Verify update
            $newSettings = getSettings();
            echo "New site title: " . $newSettings['site_title'] . "<br>";
        } else {
            echo "✗ Settings update failed<br>";
        }
        
    } else {
        echo "✗ site_settings table does not exist<br>";
    }
} catch(Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "<br>";
}
?>