<?php

class TestEnv
{
    public static ?\BeelineOrd\Authorization\Credentials $credentials = null;
    public static ?\Psr\Http\Client\ClientInterface $httpClient = null;
}