<?php

namespace Ahsan\PrintifyLaravel;

use Exception;
use Illuminate\Support\Facades\Http;

class PrintifyService
{
    /**
     * The Printify API token.
     *
     * @var string
     */
    protected $token;

    /**
     * The Printify shop ID.
     *
     * @var int|null
     */
    protected $shopId;

    /**
     * Create a new PrintifyService instance.
     *
     * @param string $token
     * @param int|null $shopId
     */
    public function __construct($token, $shopId = null)
    {
        $this->token = $token;
        $this->shopId = $shopId;
    }

    /**
     * Set the shop ID.
     *
     * @param int $shopId
     * @return $this
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
        return $this;
    }

    /**
     * Fetch all shops.
     *
     * @return array
     */
    public function getShops()
    {
        return $this->makeRequest('get', 'shops.json');
    }

    /**
     * Fetch products for the set shop.
     *
     * @return array
     * @throws Exception
     */
    public function getProducts()
    {
        $this->ensureShopIdIsSet();
        return $this->makeRequest('get', "shops/{$this->shopId}/products.json");
    }

    /**
     * Add a product to the set shop.
     *
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function addProduct(array $payload)
    {
        $this->ensureShopIdIsSet();
        return $this->makeRequest('post', "shops/{$this->shopId}/products.json", $payload);
    }

    /**
     * Fetch orders for the set shop.
     *
     * @return array
     * @throws Exception
     */
    public function getOrders()
    {
        $this->ensureShopIdIsSet();
        return $this->makeRequest('get', "shops/{$this->shopId}/orders.json");
    }

    /**
     * Ensure that the shop ID is set.
     *
     * @return void
     * @throws Exception
     */
    protected function ensureShopIdIsSet()
    {
        if (!$this->shopId) {
            throw new Exception('Shop ID is not set.');
        }
    }

    /**
     * Make a request to the Printify API.
     *
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return array
     */
    protected function makeRequest(string $method, string $uri, array $payload = [])
    {
        $response = Http::baseUrl('https://api.printify.com/v1/')
            ->withToken($this->token)
            ->{$method}($uri, $payload);

        return $response->json();
    }
}