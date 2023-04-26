<?php

include __DIR__ . '/../header.php';

use Supabase\Storage\StorageFile;

//Selecting an already created bucket for our test.
$bucket_id = 'test-bucket';
//Also creating file with unique ID.
$testFile = 'file' . uniqid() . '.png';
//Creating our StorageFile instance to upload files.
$file = new StorageFile($api_key, $reference_id, $bucket_id);
//We will upload a test file to update it.
$file->upload($testFile, 'https://gpdefvsxamnscceccczu.supabase.co/storage/v1/object/public/examples-bucket/supabase-logo.png', ['public' => false]);
//Now we will update the file using the update method. And get the image and convert into string
$img = file_get_contents(
	'https://gpdefvsxamnscceccczu.supabase.co/storage/v1/object/public/examples-bucket/supabase-logo.png'
);
$data = (string) $img;
$result = $file->update($testFile, $data, ['contentType' => 'image/png']);
//print out result.
$output = json_decode($result->getBody(), true);
print_r($output);
//delete example files.
//$file->remove(["$testFile"]);
