<?php

namespace BrowshotAPI;

use BrowshotAPI\Message\ScreenshotCreateRequest;
use BrowshotAPI\Message\ScreenshotResponse;
use BrowshotAPI\Message\ScreenshotStatus;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class BrowshotClient
{
    const URI_SCREENSHOT_CREATE = 'screenshot/create';
    const URI_SCREENSHOT_INFO = 'screenshot/info';

    /** @var ClientInterface */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function createScreenshot(ScreenshotCreateRequest $request)
    {
        $response = new ScreenshotResponse();

        $query = [
            'url'           => $request->getUrl(),
            'instance_id'   => $request->getInstanceId(),
            'cache'         => 0,
            'delay'         => $request->getDelay(),
            'flash_delay'   => $request->getFlashDelay(),
            'screen_width'  => $request->getScreenWidth(),
            'screen_height' => $request->getScreenHeight(),
        ];

        try {
            $data = $this->runApi('GET', self::URI_SCREENSHOT_CREATE, $query);

            $status = $this->getScreenshotStatus($data);

            $response
                ->setId($data['id'])
                ->setStatus($status)
                ->setError($data['error'] ?? null);
        } catch (GuzzleException $e) {
            $response
                ->setStatus($this->getScreenshotStatus('error'))
                ->setError($e->getMessage())
            ;
        } catch (\Throwable $e) {
            $response
                ->setStatus($this->getScreenshotStatus('error'))
                ->setError($e->getMessage())
            ;
        }

        return $response;
    }

    /**
     * Get screenshot status by its name
     *
     * @param $data
     * @return int
     */
    private function getScreenshotStatus($data): int
    {
        switch ($data['status']) {
            case 'in_queue':
                $status = ScreenshotStatus::IN_QUEUE;
                break;
            case 'progressing':
                $status = ScreenshotStatus::PROGRESSING;
                break;
            case 'finished':
                $status = ScreenshotStatus::FINISHED;
                break;
            case 'error':
                $status = ScreenshotStatus::ERROR;
                break;
            default:
                $status = ScreenshotStatus::UNKNOWN;
        }

        return $status;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $query
     * @return mixed
     * @throws GuzzleException
     * @throws \InvalidArgumentException
     */
    private function runApi(string $method, string $uri, array $query): mixed
    {
        $query = array_merge($query, $this->client->getConfig('query'));
        $result = $this->client->request($method, $uri, [
            'query' => $query,
        ]);

        return \GuzzleHttp\json_decode((string) $result->getBody(), true);
    }
}