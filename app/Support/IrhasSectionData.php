<?php

namespace App\Support;

class IrhasSectionData
{
    public const THEME_BASE = 'assets/main-irhas-html/irhas-html';

    public static function withDefaults(array $data, string $type): array
    {
        $defaults = config("irhas_defaults.{$type}", []);

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

    public static function themeAsset(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/') || str_starts_with($path, '/uploads/')) {
            return asset(ltrim($path, '/'));
        }

        $relative = ltrim($path, '/');

        if (str_starts_with($relative, self::THEME_BASE)) {
            return asset($relative);
        }

        return asset(self::THEME_BASE . '/' . $relative);
    }

    public static function imageUrl(array $data, string $urlKey, ?string $default = null): ?string
    {
        $value = $data[$urlKey] ?? null;

        if (! empty($value)) {
            return self::themeAsset($value);
        }

        return $default ? self::themeAsset($default) : null;
    }

    public static function esc(?string $value): string
    {
        return e($value ?? '');
    }
}
