<?php
require 'vendor/autoload.php';
$c = new \App\Http\Controllers\frontend\DoctorSearchController();
echo "Class: " . get_class($c) . "\n";
echo "Method exists: " . (method_exists($c, 'searchBySpecialty') ? 'Yes' : 'No') . "\n";
echo "Methods: " . implode(', ', get_class_methods($c)) . "\n";
