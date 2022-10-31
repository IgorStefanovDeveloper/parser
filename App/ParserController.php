<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class ParserController
{
    const UPLOAD_DIR = __DIR__ . '/../public/upload';

    public function prepareUrl($url): array
    {
        $urlParts = parse_url($url);
        return ['baseUrl' => $urlParts['scheme'] . '://' . $urlParts['host'], "path" => $urlParts['path']];
    }

    public function getImageFullUrl(string $imgPath, string $baseUrl, string $path): string
    {
        $imgArray = parse_url($imgPath);
        if (count($imgArray) === 1) {
            $imgPath = $imgArray['path'];

            if ($imgPath[0] === '.') {
                return $baseUrl . $path . substr($imgPath, 2);
            } elseif ($imgPath[0] === '/') {
                return $baseUrl . $imgArray['path'];
            }
        } else {
            return $imgPath;
        }

        return "";
    }

    public function parseUrl($url, $searchData = true, $searchTypes = false,  $types = false):array
    {
        $urlArray = $this->prepareUrl($url);

        $client = new Client(['base_uri' => $urlArray['baseUrl']]);

        try {
            $request = $client->request('GET', $urlArray['path']);
        } catch (ClientException $e) {
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());
        }

        $html = $request->getBody()->getContents();
        $images = [];
        $imagesPath = [];

        $startPattern = '/<img[^>]+src=["\']';
        $bodyPattern = '';

        if ($searchData === false) {
            $bodyPattern .= '(?!data:image)';
        }

        $bodyPattern .= '([^>]*';

        if ($searchTypes !== false) {
            $bodyPattern .= '[.](' . $types . '))';
        } else {
            $bodyPattern .= '?)';
        }

        $endPattern = '["\'][^>]*?>/isU';

        $pattern = $startPattern . $bodyPattern . $endPattern;

        preg_match_all($pattern, $html, $images, PREG_SET_ORDER);

        foreach ($images as $image) {
            $imagePath = $this->getImageFullUrl($image[1], $urlArray['baseUrl'], $urlArray["path"]);
            if (!in_array($imagePath, $imagesPath)) {
                $imagesPath[] = $imagePath;
            }
        }

        return $imagesPath;
    }

    public function downloadFile($fileUrl)
    {
        $client = new Client(['base_uri' => $fileUrl]);

        $resource = fopen(self::UPLOAD_DIR, 'w');
        $stream = Psr7\stream_for($resource);
        try {
            $client->request('GET', $fileUrl, ['save_to' => $stream]);
        } catch (ClientException $e) {
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());
        }
    }
}