<?php

namespace BrowshotAPI;

use BrowshotAPI\Message\ScreenshotCreateRequest;
use BrowshotAPI\Message\ScreenshotInfoRequest;
use BrowshotAPI\Message\ScreenshotResponse;
use BrowshotAPI\Message\ScreenshotStatus;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class BrowshotAPI
{
    const URI_SCREENSHOT_CREATE = 'screenshot/create';
    const URI_SCREENSHOT_INFO = 'screenshot/info';

    /** @var ClientInterface */
    private $client;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        ClientInterface $client,
        LoggerInterface $logger
    ) {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getScreenshotInfo(ScreenshotInfoRequest $request)
    {
        $query = [
            'id' => $request->getId(),
        ];

        return $this->getScreenshotResponse(self::URI_SCREENSHOT_INFO, $query);
    }

    public function createScreenshot(ScreenshotCreateRequest $request)
    {
        $query = [
            'url'           => $request->getUrl(),
            'instance_id'   => $request->getInstanceId(),
            'cache'         => 0,
            'delay'         => $request->getDelay(),
            'flash_delay'   => $request->getFlashDelay(),
            'screen_width'  => $request->getScreenWidth(),
            'screen_height' => $request->getScreenHeight(),
        ];

        return $this->getScreenshotResponse(self::URI_SCREENSHOT_CREATE, $query);
    }

    /**
     * @param string $uri
     * @param array $query
     * @return ScreenshotResponse
     */
    private function getScreenshotResponse(string $uri, array $query): ScreenshotResponse
    {
        $this->logger->debug('get screenshot response', compact(['uri', 'query']));

        $response = new ScreenshotResponse();

        try {
            $result = $this->runApi('GET', $uri, $query);

            $this->logger->debug('get api result', $result);
        } catch (GuzzleException $e) {
            $this->logger->warning('exception', [
                'class' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            $response
                ->setStatus($this->getScreenshotStatus('error'))
                ->setError($e->getMessage())
            ;

            return $response;
        } catch (\Throwable $e) {
            $this->logger->warning('exception', [
                'class' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            $response
                ->setStatus($this->getScreenshotStatus('error'))
                ->setError($e->getMessage())
            ;

            return $response;
        }

        $response
            ->setId($result['id'] ?? null)
            ->setError($result['error'] ?? null)
            ->setScreenshotUrl($result['screenshot_url'] ?? null)
            ->setStatus($this->getScreenshotStatus($result['status'] ?? null))
        ;

        return $response;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $query
     * @return array
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    private function runApi(string $method, string $uri, array $query): array
    {
        $query = array_merge($query, $this->client->getConfig('query'));

        try {
            $result = $this->client->request($method, $uri, [
                'query' => $query,
            ]);

        } catch (BadResponseException $ex) {
            $result = $ex->getResponse();

        }

        $this->logger->debug('browshot response', [
            'body' => $result->getBody(),
        ]);

        return \GuzzleHttp\json_decode((string) $result->getBody(), true);
    }

    /**
     * Get screenshot status by its name
     *
     * @param $status
     * @return int
     */
    private function getScreenshotStatus($status): int
    {
        switch (mb_strtoupper($status)) {
            case 'IN_QUEUE':
                return ScreenshotStatus::IN_QUEUE;
            case 'PROCESSING':
                return ScreenshotStatus::PROCESSING;
            case 'FINISHED':
                return ScreenshotStatus::FINISHED;
            case 'ERROR':
                return ScreenshotStatus::ERROR;
        }

        return ScreenshotStatus::UNKNOWN;
    }
}