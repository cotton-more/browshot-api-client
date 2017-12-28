<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: BrowshotAPI/ScreenshotCreateRequest.proto

namespace BrowshotAPI\Message;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>BrowshotAPI.Message.ScreenshotCreateRequest</code>
 */
class ScreenshotCreateRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Url to take screenshot 
     *
     * Generated from protobuf field <code>string url = 2;</code>
     */
    private $url = '';
    /**
     * Instance id to use   
     *
     * Generated from protobuf field <code>uint32 instanceId = 3;</code>
     */
    private $instanceId = 0;
    /**
     * Use a previous screenshot for same instanse and url 
     *
     * Generated from protobuf field <code>uint32 cache = 4;</code>
     */
    private $cache = 0;
    /**
     * Number of seconds to wait after the page has loaded 
     *
     * Generated from protobuf field <code>uint32 delay = 5;</code>
     */
    private $delay = 0;
    /**
     * Number of seconds to wait after the page has loaded if Flash elements are present 
     *
     * Generated from protobuf field <code>uint32 flashDelay = 6;</code>
     */
    private $flashDelay = 0;
    /**
     * Width of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenWidth = 7;</code>
     */
    private $screenWidth = 0;
    /**
     * Height of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenHeight = 8;</code>
     */
    private $screenHeight = 0;

    public function __construct() {
        \GPBMetadata\BrowshotAPI\ScreenshotCreateRequest::initOnce();
        parent::__construct();
    }

    /**
     * Url to take screenshot 
     *
     * Generated from protobuf field <code>string url = 2;</code>
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Url to take screenshot 
     *
     * Generated from protobuf field <code>string url = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->url = $var;

        return $this;
    }

    /**
     * Instance id to use   
     *
     * Generated from protobuf field <code>uint32 instanceId = 3;</code>
     * @return int
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * Instance id to use   
     *
     * Generated from protobuf field <code>uint32 instanceId = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setInstanceId($var)
    {
        GPBUtil::checkUint32($var);
        $this->instanceId = $var;

        return $this;
    }

    /**
     * Use a previous screenshot for same instanse and url 
     *
     * Generated from protobuf field <code>uint32 cache = 4;</code>
     * @return int
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Use a previous screenshot for same instanse and url 
     *
     * Generated from protobuf field <code>uint32 cache = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setCache($var)
    {
        GPBUtil::checkUint32($var);
        $this->cache = $var;

        return $this;
    }

    /**
     * Number of seconds to wait after the page has loaded 
     *
     * Generated from protobuf field <code>uint32 delay = 5;</code>
     * @return int
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * Number of seconds to wait after the page has loaded 
     *
     * Generated from protobuf field <code>uint32 delay = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setDelay($var)
    {
        GPBUtil::checkUint32($var);
        $this->delay = $var;

        return $this;
    }

    /**
     * Number of seconds to wait after the page has loaded if Flash elements are present 
     *
     * Generated from protobuf field <code>uint32 flashDelay = 6;</code>
     * @return int
     */
    public function getFlashDelay()
    {
        return $this->flashDelay;
    }

    /**
     * Number of seconds to wait after the page has loaded if Flash elements are present 
     *
     * Generated from protobuf field <code>uint32 flashDelay = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setFlashDelay($var)
    {
        GPBUtil::checkUint32($var);
        $this->flashDelay = $var;

        return $this;
    }

    /**
     * Width of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenWidth = 7;</code>
     * @return int
     */
    public function getScreenWidth()
    {
        return $this->screenWidth;
    }

    /**
     * Width of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenWidth = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setScreenWidth($var)
    {
        GPBUtil::checkUint32($var);
        $this->screenWidth = $var;

        return $this;
    }

    /**
     * Height of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenHeight = 8;</code>
     * @return int
     */
    public function getScreenHeight()
    {
        return $this->screenHeight;
    }

    /**
     * Height of the browser window 
     *
     * Generated from protobuf field <code>uint32 screenHeight = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setScreenHeight($var)
    {
        GPBUtil::checkUint32($var);
        $this->screenHeight = $var;

        return $this;
    }

}

