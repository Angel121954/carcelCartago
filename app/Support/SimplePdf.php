<?php

namespace App\Support;

class SimplePdf
{
    public static function fromRows(string $title, array $metaLines, array $headers, array $rows): string
    {
        $chunks = array_chunk($rows, 28);
        $chunks = $chunks === [] ? [[]] : $chunks;

        $objects = [];
        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[3] = '<< /Type /Font /Subtype /Type1 /BaseFont /Courier >>';

        $kids = [];
        $objectId = 4;

        foreach ($chunks as $index => $chunk) {
            $contentId = $objectId;
            $pageId = $objectId + 1;

            $objects[$contentId] = self::contentStream($title, $metaLines, $headers, $chunk, $index + 1, count($chunks));
            $objects[$pageId] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 3 0 R >> >> /Contents '.$contentId.' 0 R >>';
            $kids[] = $pageId.' 0 R';
            $objectId += 2;
        }

        $objects[2] = '<< /Type /Pages /Kids ['.implode(' ', $kids).'] /Count '.count($chunks).' >>';

        $pdf = "%PDF-1.4\n%\xE2\xE3\xCF\xD3\n";
        $offsets = [0];

        ksort($objects);
        foreach ($objects as $id => $body) {
            $offsets[$id] = strlen($pdf);
            $pdf .= $id." 0 obj\n".$body."\nendobj\n";
        }

        $xrefPosition = strlen($pdf);
        $maxId = max(array_keys($objects));

        $pdf .= "xref\n0 ".($maxId + 1)."\n";
        $pdf .= "0000000000 65535 f \n";
        for ($id = 1; $id <= $maxId; $id++) {
            $pdf .= sprintf('%010d 00000 n'."\n", $offsets[$id] ?? 0);
        }

        $pdf .= 'trailer << /Size '.($maxId + 1)." /Root 1 0 R >>\n";
        $pdf .= "startxref\n".$xrefPosition."\n%%EOF";

        return $pdf;
    }

    private static function contentStream(string $title, array $metaLines, array $headers, array $rows, int $pageNumber, int $pageCount): string
    {
        $lines = [];
        $y = 790;

        $lines[] = self::textBlock(40, $y, 14, $title);
        $y -= 20;

        foreach ($metaLines as $metaLine) {
            $lines[] = self::textBlock(40, $y, 9, $metaLine);
            $y -= 12;
        }

        $y -= 6;
        $lines[] = self::textBlock(40, $y, 8, self::formatRow($headers));
        $y -= 10;
        $lines[] = self::textBlock(40, $y, 8, str_repeat('-', 108));
        $y -= 12;

        if ($rows === []) {
            $lines[] = self::textBlock(40, $y, 8, 'Sin registros en el rango seleccionado.');
        } else {
            foreach ($rows as $row) {
                $lines[] = self::textBlock(40, $y, 8, self::formatRow($row));
                $y -= 12;
            }
        }

        $lines[] = self::textBlock(40, 24, 8, 'Pagina '.$pageNumber.' de '.$pageCount);

        $stream = implode("\n", $lines);

        return '<< /Length '.strlen($stream)." >>\nstream\n".$stream."\nendstream";
    }

    private static function textBlock(int $x, int $y, int $fontSize, string $text): string
    {
        return 'BT /F1 '.$fontSize.' Tf '.$x.' '.$y.' Td ('.self::escape(self::latin($text)).') Tj ET';
    }

    private static function formatRow(array $columns): string
    {
        $widths = [4, 24, 24, 20, 12, 8, 8];
        $formatted = [];

        foreach ($widths as $index => $width) {
            $formatted[] = self::fit((string) ($columns[$index] ?? ''), $width);
        }

        return implode(' | ', $formatted);
    }

    private static function fit(string $value, int $width): string
    {
        $value = trim($value);

        if (strlen($value) <= $width) {
            return str_pad($value, $width);
        }

        return substr($value, 0, max($width - 3, 0)).'...';
    }

    private static function latin(string $value): string
    {
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT', $value);

        return $converted === false ? $value : $converted;
    }

    private static function escape(string $value): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $value);
    }
}
