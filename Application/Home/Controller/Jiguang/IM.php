<?php
header("Content-type:text/html; charset=UTF-8");


class IM {
    private $client;
    public function __construct($client) {
        $this->client = Http::getInstance($client);
    }
    public function get($uri, array $query = []) {
        return $this->client->get($uri, $query);
    }
    public function post($uri, array $body = []) {
        return $this->client->post($uri, $body);
    }
    public function put($uri, array $body = []) {
        return $this->client->put($uri, $body);
    }
    public function del($uri, array $body = []) {
        return $this->client->delete($uri, $body);
    }
    protected function getClient() {
        return $this->client;
    }
}