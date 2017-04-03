<?php

/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
      @$size[$factor];
}

/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

/**
 * Is the mime type an image
 */
function is_video($mimeType)
{
    return starts_with($mimeType, 'video/');
}

/**
 * Is the mime type an image
 */
function is_application($mimeType)
{
    return starts_with($mimeType, 'application/pdf');
}
