<?php
// YouTube video URL
if (isset($argv[1])) {
    $video_url = $argv[1];
} else {
    echo "No video URL provided.";
    exit(1);
}
// Define the output file path
parse_str(parse_url($video_url, PHP_URL_QUERY), $url_params);
$video_id = $url_params['v'] ?? null;

if (!$video_id) {
    echo "Invalid YouTube URL.";
    exit(1);
}

// Define the output file path using the video ID
$output_file = $video_id . ".wav";
// Full path to yt-dlp if not in PATH
$yt_dlp_path = "yt-dlp.exe";

// Command to download audio using yt-dlp
$command = "$yt_dlp_path -x --audio-format wav -o \"$output_file\" \"$video_url\"";

// Execute the command
exec($command, $output, $return_var);

// Check if the command was successful
if ($return_var === 0) {
    echo "Audio downloaded successfully to $output_file";
} else {
    echo "Error downloading audio.";
    print_r($output); // Optional: print output for debugging
}
?>
