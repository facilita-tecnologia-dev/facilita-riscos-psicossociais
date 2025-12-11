@props([
    'type',
])

@php
    $type = strtolower($type);

    $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp'];
    $documentTypes = ['pdf', 'doc', 'docx', 'txt', 'rtf'];
    $spreadsheetTypes = ['xls', 'xlsx', 'csv'];
    $presentationTypes = ['ppt', 'pptx'];
    $compactArchiveTypes = ['zip', 'rar', '7z', 'tar', 'gz'];
    $audioTypes = ['mp3', 'wav', 'ogg', 'm4a'];
    $videoTypes = ['mp4', 'avi', 'mov', 'mkv'];
@endphp

@if (in_array($type, $imageTypes))
    <x-icon icon="file-image" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $documentTypes))
    <x-icon icon="file-document" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $spreadsheetTypes))
    <x-icon icon="file-spreadsheet" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $presentationTypes))
    <x-icon icon="file-presentation" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $compactArchiveTypes))
    <x-icon icon="file-compact" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $audioTypes))
    <x-icon icon="file-audio" class="text-secondary-text h-6 w-6 object-scale-down" />
@elseif (in_array($type, $videoTypes))
    <x-icon icon="file-video" class="text-secondary-text h-6 w-6 object-scale-down" />
@else
    <x-icon icon="file" class="text-secondary-text h-6 w-6 object-scale-down" />
@endif
