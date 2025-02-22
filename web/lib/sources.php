<?php
/*
 * ddr-finder
 * Copyright (c) 2015-2021 Andrés Cordero
 *
 * Web: https://github.com/Andrew67/ddr-finder
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Class Sources
 * Contains data and helpers for information regarding the available data sources.
 * Tweak them here!!
 */
class Sources {
    /** @var array Raw source data, in same format as v2.0 API output. */
    public static array $data = [
        'ziv' => [
            'shortName' => 'ziv',
            'name' => 'Zenius -I- vanisher.com',
            'homepageURL' => 'https://zenius-i-vanisher.com/',
            'infoURL' => 'https://zenius-i-vanisher.com/v5.2/arcade.php?id=${sid}#summary',
            'mInfoURL' => 'https://ddrfinder-proxy.andrew67.com/ziv/info/${sid}',
            'hasDDR' => true,
        ],
        'navi' => [
            'shortName' => 'navi',
            'name' => 'DDR-Navi',
            'homepageURL' => 'https://www.ddr-navi.jp/',
            'infoURL' => 'https://www.ddr-navi.jp/shop/?id=${sid}',
            'mInfoURL' => 'https://www.ddr-navi.jp/shop/?id=${sid}',
            'hasDDR' => true,
        ],
        'osm' => [
            'shortName' => 'osm',
            'name' => 'OpenStreetMap',
            'homepageURL' => 'https://www.openstreetmap.org/',
            'infoURL' => 'https://ddrfinder-proxy.andrew67.com/osm/redirect/${sid}',
            'mInfoURL' => 'https://ddrfinder-proxy.andrew67.com/osm/redirect/${sid}',
            'hasDDR' => false,
        ],
        // The intention with "fallback" is to provide a URL that redirects to source, based on actual database ID
        'fallback' => [
            'shortName' => 'fallback',
            'name' => 'Source Website',
            'homepageURL' => 'https://ddrfinder.andrew67.com/',
            'infoURL' => 'https://ddrfinder.andrew67.com/info.php?id=${id}',
            'mInfoURL' => 'https://ddrfinder.andrew67.com/info.php?id=${id}',
            'hasDDR' => false,
        ],
    ];

    /**
     * Returns a source object with information for the specified sources, and "fallback".
     * Invalid sources are ignored.
     * @param array $sources Array of source strings.
     * @return array API v2.0 output format source data.
     */
    public static function getSourceObject(array $sources): array {
        if ('all' === $sources[0]) return self::$data;

        $d = array();
        foreach ($sources as $s) {
            if (array_key_exists($s, self::$data)) {
                $d[$s] = self::$data[$s];
            }
        }
        $d['fallback'] = self::$data['fallback'];

        return $d;
    }

    /**
     * Returns a source array with information for the specified sources, and "fallback".
     * Invalid sources are ignored.
     * @param array $sources Array of source strings.
     * @return array API v3.0 output format source data.
     */
    public static function getSourceArray(array $sources): array {
        if ('all' === $sources[0]) $sources = array_keys(self::$data);
        else $sources[] = 'fallback';

        $d = array();
        foreach ($sources as $s) {
            if (array_key_exists($s, self::$data)) {
                $d[] = self::$data[$s];
            }
        }

        return $d;
    }

    /**
     * Returns the shortnames of the available sources.
     * @return array Shortnames of the available sources.
     */
    public static function getSourceNames(): array {
        return array_keys(self::$data);
    }

    /**
     * Whether the specified source is valid. "all" is valid, while "fallback" is not.
     * @param string $source Source name to validate.
     * @return bool Whether the specified source is valid.
     */
    public static function isValidSource(string $source): bool {
        if ('all' === $source) return true;
        elseif ('fallback' === $source) return false;
        else return array_key_exists($source, self::$data);
    }
}