<?php

namespace App\Support;

class NewDesignSectionData
{
    public static function withDefaults(array $data, string $type): array
    {
        $defaults = config("new_design_defaults.{$type}", []);

        return array_replace_recursive($defaults, $data);
    }

    public static function get(array $data, string $key, mixed $default = ''): mixed
    {
        return $data[$key] ?? $default;
    }

    public static function items(array $data, string $key = 'items'): array
    {
        $items = $data[$key] ?? [];

        return is_array($items) ? $items : [];
    }

    public static function imageUrl(array $data, string $uploadKey, string $urlKey, ?string $default = null): ?string
    {
        $source = $data["{$uploadKey}_source"] ?? ($data['background_image_source'] ?? 'url');

        if ($source === 'upload' && ! empty($data[$uploadKey])) {
            $path = $data[$uploadKey];
            if (str_starts_with($path, 'http')) {
                return $path;
            }

            $normalized = str_starts_with($path, 'uploads/')
                ? $path
                : 'uploads/' . ltrim($path, '/');

            return asset($normalized);
        }

        if (! empty($data[$urlKey])) {
            return $data[$urlKey];
        }

        return $default;
    }

    public static function bgStyle(array $data, ?string $defaultUrl = null, string $extra = ''): string
    {
        $url = self::imageUrl($data, 'background_image', 'background_image_url', $defaultUrl);
        $styles = [];

        if ($url) {
            $styles[] = "background-image: url('{$url}')";
            $styles[] = 'background-position: center center';
            $styles[] = 'background-size: cover';
            $styles[] = 'background-repeat: no-repeat';
        }

        if ($extra) {
            $styles[] = trim($extra, '; ');
        }

        return implode('; ', $styles);
    }

    public static function mobileBgStyle(array $data, ?string $defaultUrl = null): ?string
    {
        $url = ! empty($data['mobile_background_image_url']) ? $data['mobile_background_image_url'] : $defaultUrl;

        return $url ? "background-image: url('{$url}') !important" : null;
    }

    public static function nl2br(?string $value): string
    {
        return nl2br(e($value ?? ''));
    }

    public static function html(?string $value): string
    {
        return $value ?? '';
    }
}
