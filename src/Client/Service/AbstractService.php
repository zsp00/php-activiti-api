<?php

namespace Activiti\Client\Service;

use Activiti\Client\Exception\ActivitiException;
use Activiti\Client\ModelFactoryInterface;
use Activiti\Client\ObjectSerializerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\json_decode;

abstract class AbstractService
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ModelFactoryInterface
     */
    private $modelFactory;

    /**
     * @var ObjectSerializerInterface
     */
    protected $serializer;

    public function __construct(ClientInterface $client, ModelFactoryInterface $modelFactory, ObjectSerializerInterface $objectSerializer)
    {
        $this->client = $client;
        $this->modelFactory = $modelFactory;
        $this->serializer = $objectSerializer;
    }

    protected function call(callable $callable, $class = null)
    {
        try {
            /** @var ResponseInterface $response */
            $response = $callable($this->client);
            $contents = $response->getBody()->getContents();
            if ($class !== null && $contents !== '') {
                return $this->hydrate($class, $this->decode($contents));
            }

            return $contents;
        } catch (RequestException $ex) {
            $message = null;
            if ($ex->getResponse() !== null) {
                $contents = $ex->getResponse()->getBody()->getContents();
                if ($contents !== null) {
                    $contents = $this->decode($contents);
                    if (array_key_exists('msg', $contents)) {
                        $message = $contents['msg'];
                    }
                }
            }

            if ($message === null) {
                $message = $ex->getMessage();
            }
            throw new ActivitiException($message, 0, $ex);
        }
    }

    /**
     * Decode API response
     *
     * @param string $contents
     * @return array
     */
    protected function decode($contents)
    {
        return json_decode($contents, true);
    }

    /**
     * Hydrate response
     *
     * @param string $class
     * @param array $data
     * @return object
     */
    protected function hydrate($class, array $data)
    {
        return $this->modelFactory->{'create' . $this->getClassShortName($class)}($data);
    }

    private function getClassShortName($class)
    {
        $parts = explode('\\', $class);
        return array_pop($parts);
    }
}
