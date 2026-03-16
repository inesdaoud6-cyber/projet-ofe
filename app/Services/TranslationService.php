<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    public static function translate(string $text, string $targetLang): string
    {
        try {
            $tr = new GoogleTranslate($targetLang);
            return $tr->translate($text);
        } catch (\Exception $e) {
            return $text;
        }
    }

    public static function translateToAll(string $text): array
    {
        return [
            'en' => self::translate($text, 'en'),
            'ar' => self::translate($text, 'ar'),
        ];
    }
}